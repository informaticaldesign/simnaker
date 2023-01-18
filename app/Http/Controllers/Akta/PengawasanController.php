<?php

namespace App\Http\Controllers\Akta;

use App\Http\Controllers\Controller;
use App\Models\AktaPengawasan;
use App\Models\AktaPengawasanMesin;
use App\Models\AktaPengawasanMesinDet;
use App\Models\Company;
use App\Models\Pengawasan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use DataTables;
use DB;

class PengawasanController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return View('akta.pengawasan.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        //
        return View('akta.pengawasan.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        //
        return View('akta.pengawasan.create');
    }

    public function mesin()
    {
        //
        return View('akta.mesin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AktaPengawasan $datapost)
    {
        //
        $validator = \Validator::make($request->all(), [
            'company_id' => ['required', 'numeric', 'min:1'],
            'address' => ['required'],
            'nama_pemilik' => ['required'],
            'add_pemilik' => ['required'],
            'nama_pengurus' => ['required'],
            'add_pengurus' => ['required'],
            'jenis_usaha' => ['required'],
            'tgl_berdiri' => ['required', 'date_format:Y-m-d'],
            'no_akte' => ['required'],
            'jml_cabang' => ['required', 'numeric', 'min:0'],

            'wni_l_bul_a' => ['required', 'numeric', 'min:0'],
            'wni_l_bul_d' => ['required', 'numeric', 'min:0'],
            'wni_p_bul_a' => ['required', 'numeric', 'min:0'],
            'wni_p_bul_d' => ['required', 'numeric', 'min:0'],
            'wna_l_bul_a' => ['required', 'numeric', 'min:0'],
            'wna_l_bul_d' => ['required', 'numeric', 'min:0'],
            'wna_p_bul_a' => ['required', 'numeric', 'min:0'],
            'wna_p_bul_d' => ['required', 'numeric', 'min:0'],
            'jml_bul_l' => ['required', 'numeric', 'min:0'],
            'jml_bul_p' => ['required', 'numeric', 'min:0'],

            'wni_l_bor_a' => ['required', 'numeric', 'min:0'],
            'wni_l_bor_d' => ['required', 'numeric', 'min:0'],
            'wni_p_bor_a' => ['required', 'numeric', 'min:0'],
            'wni_p_bor_d' => ['required', 'numeric', 'min:0'],
            'wna_l_bor_a' => ['required', 'numeric', 'min:0'],
            'wna_l_bor_d' => ['required', 'numeric', 'min:0'],
            'wna_p_bor_a' => ['required', 'numeric', 'min:0'],
            'wna_p_bor_d' => ['required', 'numeric', 'min:0'],
            'jml_bor_l' => ['required', 'numeric', 'min:0'],
            'jml_bor_p' => ['required', 'numeric', 'min:0'],

            'wni_l_hl_a' => ['required', 'numeric', 'min:0'],
            'wni_l_hl_d' => ['required', 'numeric', 'min:0'],
            'wni_p_hl_a' => ['required', 'numeric', 'min:0'],
            'wni_p_hl_d' => ['required', 'numeric', 'min:0'],
            'wna_l_hl_a' => ['required', 'numeric', 'min:0'],
            'wna_l_hl_d' => ['required', 'numeric', 'min:0'],
            'wna_p_hl_a' => ['required', 'numeric', 'min:0'],
            'wna_p_hl_d' => ['required', 'numeric', 'min:0'],
            'jml_hl_l' => ['required', 'numeric', 'min:0'],
            'jml_hl_p' => ['required', 'numeric', 'min:0'],

            'wni_l_pkwt_a' => ['required', 'numeric', 'min:0'],
            'wni_l_pkwt_d' => ['required', 'numeric', 'min:0'],
            'wni_p_pkwt_a' => ['required', 'numeric', 'min:0'],
            'wni_p_pkwt_d' => ['required', 'numeric', 'min:0'],
            'wna_l_pkwt_a' => ['required', 'numeric', 'min:0'],
            'wna_l_pkwt_d' => ['required', 'numeric', 'min:0'],
            'wna_p_pkwt_a' => ['required', 'numeric', 'min:0'],
            'wna_p_pkwt_d' => ['required', 'numeric', 'min:0'],
            'jml_pkwt_l' => ['required', 'numeric', 'min:0'],
            'jml_pkwt_p' => ['required', 'numeric', 'min:0'],

            'wni_l_pkwtt_a' => ['required', 'numeric', 'min:0'],
            'wni_l_pkwtt_d' => ['required', 'numeric', 'min:0'],
            'wni_p_pkwtt_a' => ['required', 'numeric', 'min:0'],
            'wni_p_pkwtt_d' => ['required', 'numeric', 'min:0'],
            'wna_l_pkwtt_a' => ['required', 'numeric', 'min:0'],
            'wna_l_pkwtt_d' => ['required', 'numeric', 'min:0'],
            'wna_p_pkwtt_a' => ['required', 'numeric', 'min:0'],
            'wna_p_pkwtt_d' => ['required', 'numeric', 'min:0'],
            'jml_pkwtt_l' => ['required', 'numeric', 'min:0'],
            'jml_pkwtt_p' => ['required', 'numeric', 'min:0'],

            'gaya_gerak' => ['required'],
            'jns_pesawat_tenaga' => ['required'],
            'jml_pesawat_tenaga' => ['required', 'numeric'],
            'bahan_baku' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->toArray()
            ], 422);
        }
        $users = Auth::user();
        unset($request['_token']);
        if ($request->id) {
            $id = $request->id;
            $data = request()->all();
            $data['status'] = 'terkirim';
            $data['updated_by'] = $users->id;
            unset($request['id']);
            $result = AktaPengawasan::where('id', $id)->update($data);
        } else {
            unset($request['id']);
            $sptRunNo = $this->getNoIdxSpt();
            $sptIdx = '560/' . str_pad($sptRunNo, 3, '0', STR_PAD_LEFT) . '-DTKT/WASNAKER/' . $this->numberToRomanRepresentation(date('m')) . '/' . date('Y');
            $data = request()->all();
            $data['status'] = 'terkirim';
            $data['nomor_akta'] = $sptIdx;
            $data['created_by'] = $users->id;
            $result = AktaPengawasan::create($data);
            if ($result) {
                DB::table('sim_spt_no')->insert([
                    'spt_id' => $result->id,
                    'spt_run_no' => $sptRunNo,
                    'spt_idx_no' => $sptIdx,
                    'category' => 'akta',
                    'created_at' => date('Y-m-d H:i:s'),
                    'created_by' => $users->id
                ]);
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Update user success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengawasan  $pengawasan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $perusahaans = \App\Models\Perusahaan::pluck('name', 'id');
        $data = Pengawasan::select([
            'pengawasans.id',
            'pengawasans.tgl_pemeriksaan',
            'pengawasans.perusahaan',
            'pengawasans.pemeriksa',
            'users.name AS nama_pemeriksa',
            'perusahaans.name AS nama_perusahaan'
        ])
            ->leftJoin('perusahaans', 'perusahaans.id', '=', 'pengawasans.perusahaan')
            ->leftJoin('users', 'users.id', '=', 'pengawasans.pemeriksa')
            ->where('pengawasans.id', '=', $id)
            ->first();
        return View('pengawasan.view', [
            'datastore' => $data,
            'perusahaans' => $perusahaans
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengawasan  $pengawasan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $perusahaans = \App\Models\Perusahaan::pluck('name', 'id');
        $data = Pengawasan::select([
            'pengawasans.id',
            'pengawasans.tgl_pemeriksaan',
            'pengawasans.perusahaan',
            'pengawasans.pemeriksa',
            'users.name AS nama_pemeriksa',
            'perusahaans.name AS nama_perusahaan'
        ])
            ->leftJoin('perusahaans', 'perusahaans.id', '=', 'pengawasans.perusahaan')
            ->leftJoin('users', 'users.id', '=', 'pengawasans.pemeriksa')
            ->where('pengawasans.id', '=', $id)
            ->first();
        return View('pengawasan.edit', [
            'datastore' => $data,
            'perusahaans' => $perusahaans
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengawasan  $pengawasan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengawasan $pengawasan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengawasan  $pengawasan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Pengawasan::find($id)->delete();
        return response()->json(['success' => true]);
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $data = Pengawasan::select([
                'pengawasans.id',
                'pengawasans.tgl_pemeriksaan',
                'pengawasans.perusahaan',
                'pengawasans.pemeriksa',
                'users.name AS nama_pemeriksa',
                'perusahaans.name AS nama_perusahaan'
            ])
                ->leftJoin('perusahaans', 'perusahaans.id', '=', 'pengawasans.perusahaan')
                ->leftJoin('users', 'users.id', '=', 'pengawasans.pemeriksa');
            return DataTables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->orWhere('users.name', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                ->orWhere('perusahaans.name', 'LIKE', "%" . Str::lower($search['value']) . "%");
                        });
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . url('pengawasan/' . $row->id . '/show/') . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="action-view"><i class="fas fa-eye text-success"></i></a> ';
                    $btn .= '<a href="' . url('pengawasan/' . $row->id . '/edit/') . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="action-edit"><i class="fas fa-pencil-alt text-warning"></i></a> ';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="action-delete"><i class="fas fa-trash text-danger"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function combo_company(Request $request)
    {
        $page = $request->page;
        $term = trim($request->term);
        $resultCount = 25;

        $offset = ($page - 1) * $resultCount;
        $company = Company::where('m_company.name', 'LIKE', '%' . strtolower($term) . '%')
            ->skip($offset)
            ->take($resultCount)
            ->get(['m_company.id', DB::raw('m_company.name as text'), 'm_company.address']);

        $count = Count(Company::where('m_company.name', 'LIKE', '%' . strtolower($term) . '%')
            ->get(['m_company.id', DB::raw('m_company.name as text')]));
        $endCount = $offset + $resultCount;
        $morePages = $count > $endCount;

        return response()->json([
            'results' => $company,
            'pagination' => [
                'more' => $morePages
            ]
        ]);
    }

    function getNoIdxSpt()
    {
        $sptNo = DB::table('sim_spt_no')->where('category', 'akta')->max('spt_run_no');
        return $sptNo + 1;
    }

    function numberToRomanRepresentation($number)
    {
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

    public function list_akta(Request $request)
    {
        # code...
        if ($request->ajax()) {
            $data = AktaPengawasan::select([
                'sim_akta_pengawasan.id',
                'sim_akta_pengawasan.nomor_akta',
                'sim_akta_pengawasan.nama_pemilik',
                'users.name AS created_by',
                'm_company.name AS nama_perusahaan',
                'users.name',
                'sim_akta_pengawasan.status'
            ])
                ->leftJoin('m_company', 'm_company.id', '=', 'sim_akta_pengawasan.company_id')
                ->leftJoin('users', 'users.id', '=', 'sim_akta_pengawasan.created_by');
            return DataTables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->orWhere('users.name', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                ->orWhere('m_company.name', 'LIKE', "%" . Str::lower($search['value']) . "%");
                        });
                    }
                })
                ->editColumn('status', function ($row) {
                    return '<span class="badge bg-success">' . $row->status . '</span>';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . url('/admin/pengawasan/' . $row->id . '/show-akta/') . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="action-view"><i class="fas fa-eye text-success"></i></a> ';
                    if ($row->status == 'draft') {
                        $btn .= '<a href="' . url('/admin/pengawasan/' . $row->id . '/edit-akta/') . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="action-edit"><i class="fas fa-pencil-alt text-warning"></i></a> ';
                    }
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="action-delete"><i class="fas fa-trash text-danger"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }

    public function destroy_akta($id)
    {
        //
        AktaPengawasan::find($id)->delete();
        return response()->json(['success' => true]);
    }

    public function edit_akta($id)
    {
        $data = AktaPengawasan::select('sim_akta_pengawasan.*', 'm_company.name AS company_name')
            ->leftJoin('m_company', 'm_company.id', '=', 'sim_akta_pengawasan.company_id')
            ->where('sim_akta_pengawasan.id', $id)
            ->first();
        return View('akta.pengawasan.edit', [
            'data' => $data
        ]);
    }

    public function show_akta($id)
    {
        $data = AktaPengawasan::select('sim_akta_pengawasan.*', 'm_company.name AS company_name')
            ->leftJoin('m_company', 'm_company.id', '=', 'sim_akta_pengawasan.company_id')
            ->where('sim_akta_pengawasan.id', $id)
            ->first();
        return View('akta.pengawasan.view', [
            'data' => $data
        ]);
    }

    public function store_mesin(Request $request)
    {
        # code...
        $validator = \Validator::make($request->all(), [
            'company_id' => ['required', 'numeric', 'min:1'],
            'nama_motor.*' => ['required'],
            'jml_motor.*' => ['required', 'numeric', 'min:0'],
            'daya_motor.*' => ['required', 'numeric', 'min:0'],
            'ttl_daya_motor.*' => ['required', 'numeric', 'min:0'],
            'keterangan.*' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->toArray()
            ], 422);
        }
        $users = Auth::user();
        unset($request['_token']);
        $datapost['company_id'] = $request->company_id;
        $datapost['address'] = $request->address;
        $detail = false;
        if ($request->id) {
            $datapost['updated_at'] = date('Y-m-d H:i:s');
            $datapost['updated_by'] = $users->id;
            $result = AktaPengawasanMesin::where('id', $request->id)->update($datapost);
            if ($result) {
                $detail = true;
            }
        } else {
            $datapost['created_at'] = date('Y-m-d H:i:s');
            $datapost['created_by'] = $users->id;
            $result = AktaPengawasanMesin::create($datapost);
            if ($result) {
                $detail = true;
            }
        }
        if ($detail) {
            $nama_motor = $request->nama_motor;
            foreach ($nama_motor as $key => $value) {
                # code...
                AktaPengawasanMesinDet::create([
                    'nama_motor' => $value,
                    'jml_motor' => $request->jml_motor[$key],
                    'daya_motor' => $request->daya_motor[$key],
                    'ttl_daya_motor' => $request->ttl_daya_motor[$key],
                    'keterangan' => $request->keterangan[$key],
                    'created_by',
                    'updated_by'
                ]);
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Update user success',
        ]);
    }
}
