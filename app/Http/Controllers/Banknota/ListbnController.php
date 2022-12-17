<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Banknota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Banknota\Banknota;
use App\Models\Suket;
use App\Models\Spt;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Support\Carbon;
use App\Models\Banknota\Relbank;
use DB;
use PDF;
use URL;

/**
 * Description of ListbnController
 *
 * @author heryhandoko
 */
class ListbnController extends Controller {

    private $version = 1;
    //put your code here
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return View('banknota.listbn.index');
    }

    public function fetch(Request $request) {
        if ($request->ajax()) {
            $data = Banknota::select('*')->where('version', $this->version);
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->filter(function ($instance) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $instance->where(function($w) use($request) {
                                        $search = $request->get('search');
                                        $w->orWhere('document_no', 'LIKE', "%" . Str::lower($search['value']) . "%");
                                    });
                                }
                            })
                            ->addColumn('status', function($row) {
                                $btn = '';
                                if ($row->status == 'open') {
                                    $btn = '<small class="badge badge-warning">Konsep</small>';
                                } elseif ($row->status == 'send') {
                                    $btn = '<small class="badge badge-info">Terkirim</small>';
                                } elseif ($row->status == 'reject') {
                                    $btn = '<small class="badge badge-danger">Ditolak</small>';
                                } else {
                                    $btn = '<small class="badge badge-success">Disetuji</small>';
                                }
                                return $btn;
                            })
                            ->addColumn('action', function($row) {
                                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->uuid . '" data-original-title="Cetak" class="action-cetak btn btn-warning btn-sm"><i class="fas fa-print"></i></a> ';
                                $btn .= '<a href="' . url('banknota/listbn/view' . '/' . $row->uuid) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="action-view btn btn-primary btn-sm"><i class="fas fa-eye"></i></a> ';
                                if ($row->status == 'open') {
                                    $btn .= '<a href="' . url('banknota/listbn/' . $row->uuid . '/edit') . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="action-edit btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a> ';
                                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="action-delete btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';
                                }
                                return $btn;
                            })
                            ->rawColumns(['status', 'action'])
                            ->make(true);
        }
    }

    public function create() {
        $spt = Spt::whereNotNull('suket_id')->whereNull('banknota_id')->pluck('no_idx AS name', 'id');
        $sifat = \App\Models\Sifatdok::pluck('name', 'id');
        $jenis = \App\Models\Banknota\Jenis::pluck('name', 'id');
        $noIdxBanknota = $this->getNoIdxBanknota();
        $banknotaIdx = '560/' . str_pad($noIdxBanknota, 3, '0', STR_PAD_LEFT) . '-DTKT/WASNAKER/' . $this->numberToRomanRepresentation(date('m')) . '/' . date('Y');
        $kotas = \ConfigsHelper::getBankByKey('bankNotaKota');
        $kotas = explode(",", $kotas);
        return View('banknota.listbn.form', [
            'spt' => $spt,
            'sifat' => $sifat,
            'jenis' => $jenis,
            'kotas' => $kotas,
            'doc_no' => $banknotaIdx
        ]);
    }

    public function store(Request $request) {
        $validate = [
            'sifat_id' => ['required', 'integer'],
            'perihal' => ['required'],
            'kota' => ['required'],
            'jenis_id.*' => ['required'],
            'tanggal' => ['required', 'date_format:Y-m-d'],
        ];

        if ($request->id) {
            $spt = Spt::where('banknota_id', $request->id)->first();
        } else {
            $validate['spt_id'] = ['required', 'integer'];
            $spt = Spt::where('id', $request->spt_id)->first();
        }

        $validator = \Validator::make($request->all(), $validate);

        $users = Auth::user();
        if ($validator->fails()) {
            return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->toArray()
                            ], 422);
        }

        /* start get data SPT */
        $tglSpt = Carbon::createFromFormat('Y-m-d', $spt->tgl_spt)->format('d M Y');
        $suket = Suket::select(['a.id',
                    'b.id AS company_id',
                    'b.name AS company_name',
                    'b.address AS company_address',
                    'b.phone AS company_phone'
                ])
                ->from('sim_suket AS a')
                ->leftJoin('m_company AS b', 'b.id', '=', 'a.company_id')
                ->where('a.id', $spt->suket_id)
                ->first();
        $description = \ConfigsHelper::getBankByKey('bankNotaHeader');
        $descriptionFooter = \ConfigsHelper::getBankByKey('bankNotaFooter');

        $description = str_replace("variableTanggalSpt", $tglSpt, $description);
        $description = str_replace("variableNomorSpt", $spt->no_idx, $description);

        /* end get data SPT */

        $noIdxBanknota = $this->getNoIdxBanknota();
        $banknotaIdx = '560/' . str_pad($noIdxBanknota, 3, '0', STR_PAD_LEFT) . '-DTKT/WASNAKER/' . $this->numberToRomanRepresentation(date('m')) . '/' . date('Y');

        $jenis = \App\Models\Banknota\Jenis::whereIn('id', $request->jenis_id)->get();

        $input['sifat_id'] = $request->sifat_id;
        $input['perihal'] = $request->perihal;
        $input['tanggal'] = $request->tanggal;
        $input['kota'] = $request->kota;

        $input['description'] = $description;
        $input['company_name'] = $suket->company_name;
        $input['company_id'] = $suket->company_id;

        $input['kadis_name'] = \ConfigsHelper::getBankByKey('kadisNakerName');
        $input['kadis_nip'] = \ConfigsHelper::getBankByKey('kadisNakerNip');

        $input['pengawas_name'] = \ConfigsHelper::getBankByKey('pengawasNakerName');
        $input['pengawas_nip'] = \ConfigsHelper::getBankByKey('pengawasNakerNip');

        $input['description_footer'] = $descriptionFooter;

        $input['status'] = 'open';
        $input['jenis_id'] = implode(",", $request->jenis_id);
        
        $input['version'] = $this->version;

        $bankNotaId = '';
        if ($request->id) {
            $input['updated_at'] = date('Y-m-d H:i:s');
            $input['updated_by'] = $users->id;
            Banknota::where('id', $request->id)->update($input);
            $data = Banknota::find($request->id);
            $uuid = $data->uuid;
            $bankNotaId = $request->id;
        } else {
            $input['document_no'] = $banknotaIdx;
            $input['spt_id'] = $request->spt_id;
            $input['created_at'] = date('Y-m-d H:i:s');
            $input['created_by'] = $users->id;
            $input['uuid'] = Str::uuid();
            $data = Banknota::create($input);
            $uuid = $data->uuid;
            $bankNotaId = $data->id;
            DB::table('sim_banknota_no')->insert([
                'banknota_id' => $bankNotaId,
                'banknota_run_no' => $noIdxBanknota,
                'banknota_idx_no' => $banknotaIdx,
                'category' => 'banknota',
                'created_by' => $users->id,
                'version'=>$this->version
            ]);

            Spt::where('id', $request->spt_id)->update(['banknota_id' => $bankNotaId]);
        }

        if ($bankNotaId) {
            if ($jenis) {
                Relbank::where('banknota_id', $bankNotaId)->delete();
                foreach ($jenis as $key => $value) {
                    $desc = $value->description;
                    $desc = str_replace("variableNamaPerusahaan", $suket->company_name, $desc);
                    \App\Models\Banknota\Relbank::create([
                        'banknota_id' => $bankNotaId,
                        'jenis_id' => $value->id,
                        'description' => $desc,
                    ]);
                }
            }
        }
        return response()->json([
                    'success' => true,
                    'uuid' => $uuid,
                    'message' => 'Bank Nota Berhasil dibuat',
        ]);
    }

    public function edit($slug) {
        $bankNota = Banknota::where('uuid', $slug)->first();
        $spt = Spt::whereNotNull('suket_id')->pluck('no_idx AS name', 'id');
        $sifat = \App\Models\Sifatdok::pluck('name', 'id');
        $jenis = \App\Models\Banknota\Jenis::pluck('name', 'id');
        $kotas = \ConfigsHelper::getBankByKey('bankNotaKota');
        $kotas = explode(",", $kotas);
        $company = \App\Models\Company::where('id', $bankNota->company_id)->first();
        $relbank = \App\Models\Banknota\Relbank::select(['jenis_id'])->where('banknota_id', $bankNota->id)->get();
        return View('banknota.listbn.edit', [
            'spt' => $spt,
            'sifat' => $sifat,
            'jenis' => $jenis,
            'kotas' => $kotas,
            'company' => $company,
            'banknota' => $bankNota,
            'relbank' => $relbank
        ]);
    }

    public function spt($id) {
        $spt = Spt::where('id', $id)->first();
        $suket = Suket::select(['a.id',
                    'b.name AS company_name',
                    'b.address AS company_address',
                    'b.phone AS company_phone'
                ])
                ->from('sim_suket AS a')
                ->leftJoin('m_company AS b', 'b.id', '=', 'a.company_id')
                ->where('a.id', $spt->suket_id)
                ->first();
        return response()->json($suket);
    }

    function getNoIdxBanknota() {
        $sptNo = DB::table('sim_banknota_no')->where('category', 'banknota')->where('version', $this->version)->max('banknota_run_no');
        return $sptNo + 1;
    }

    function numberToRomanRepresentation($number) {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if ($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }

    public function destroy($id) {
        Banknota::find($id)->delete();
        Spt::where('banknota_id', $id)->update(['banknota_id' => null]);
        return response()->json(['success' => true]);
    }

    public function desc(Request $request) {
        $validator = \Validator::make($request->all(), [
                    'description' => ['required']
        ]);
        if ($validator->fails()) {
            return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->toArray()
                            ], 422);
        }
        \App\Models\Banknota\Relbank::where('id', $request->id)->update(['description' => $request->description]);
        return response()->json([
                    'success' => true,
                    'message' => 'Description Berhasil diupdate',
        ]);
    }

    public function preview($slug) {
        $banknota = Banknota::where('uuid', $slug)->first();
        $relbank = \App\Models\Banknota\Relbank::select(['id', 'description'])->where('banknota_id', $banknota->id)->get();
        return View('banknota.listbn.preview', [
            'banknota' => $banknota,
            'jenis' => $relbank
        ]);
    }

    public function view($slug) {
        $banknota = Banknota::where('uuid', $slug)->first();
        $relbank = \App\Models\Banknota\Relbank::select(['id', 'description'])->where('banknota_id', $banknota->id)->get();
        return View('banknota.listbn.view', [
            'banknota' => $banknota,
            'jenis' => $relbank
        ]);
    }

    public function send(Request $request) {
        $users = Auth::user();
        $input['updated_at'] = date('Y-m-d H:i:s');
        $input['updated_by'] = $users->id;
        $input['status'] = 'send';
        Banknota::where('id', $request->id)->update($input);
        return response()->json([
                    'success' => true,
                    'message' => 'Banknota Berhasil dikirim',
        ]);
    }

    public function cetak(Request $request) {
        date_default_timezone_set("Asia/Bangkok");
        ini_set('memory_limit', '1024M');
        ini_set('upload_max_filesize', '1024M');
        ini_set('post_max_size', '1024M');

        $configs = [
            'title' => 'Surat Perintah Tugas',
            'format' => 'A4',
            'orientation' => 'P',
            'author' => '',
            'watermark' => '',
            'show_watermark' => false,
            'show_watermark_image' => false,
        ];
        $banknota = Banknota::where('uuid', $request->id)->first();
        $relbank = \App\Models\Banknota\Relbank::select(['id', 'description'])->where('banknota_id', $banknota->id)->get();
        $pdf = PDF::loadView('banknota.listbn.cetak', [
                    'banknota' => $banknota,
                    'jenis' => $relbank
                        ], [], $configs);
        $slug = Str::slug($banknota->document_no, '-');
        $filename = 'bank_nota_' . $slug . '.pdf';
        $pdf->save(public_path('pdf/spt/' . $filename));
        $response = [
            'status' => 'success',
            'data' => [
                'url' => URL::to('pdf/spt/' . $filename)
            ]
        ];
        return response()->json($response);
    }

}
