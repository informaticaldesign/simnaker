<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Spt;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Auth;
use DB;
use PDF;
use URL;

/**
 * Description of SptController
 *
 * @author heryhandoko
 */
class SptController extends Controller {

    //put your code here
    public function index() {
        return View('spt.index');
    }

    //put your code here
    public function create() {
        $kotas = \App\Models\Kota::pluck('name', 'city_code AS id');
        $noIdxSpt = $this->getNoIdxSpt();
        $sptIdx =  '560/' . str_pad($noIdxSpt, 3, '0', STR_PAD_LEFT) . '-DTKT/WASNAKER/' . $this->numberToRomanRepresentation(date('m')) . '/' . date('Y');
        return View('spt.create', [
            'kotas' => $kotas,
            'no_idx' => $sptIdx
        ]);
    }

    function getNoIdxSpt() {
        $sptNo = DB::table('sim_spt_no')->where('category', 'spt')->max('spt_run_no');
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

    public function edit($id) {
        $kotas = \App\Models\Kota::pluck('name', 'city_code AS id');
        $spt = Spt::where('id', $id)->first();
        return View('spt.edit', [
            'kotas' => $kotas,
            'spt' => $spt
        ]);
    }

    public function view($id) {
        $kotas = \App\Models\Kota::pluck('name', 'city_code AS id');
        $spt = Spt::where('id', $id)->first();
        return View('spt.view', [
            'kotas' => $kotas,
            'spt' => $spt
        ]);
    }

    public function fetch(Request $request) {
        if ($request->ajax()) {
            $data = Spt::select(['a.id', 'a.no_idx', 'a.tgl_spt', DB::raw('count(b.id) as ttl_pegawai')])
                    ->from('sim_spt AS a')
                    ->leftJoin('sim_spt_biodata AS b', 'a.id', '=', 'b.spt_id')
                    ->groupByRaw('a.id,a.no_idx,a.tgl_spt');
            $users = Auth::user();

            return DataTables::of($data)
                            ->addIndexColumn()
                            ->filter(function ($instance) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $instance->where(function($w) use($request) {
                                        $search = $request->get('search');
                                        $w->orWhere('a.no_idx', 'LIKE', "%" . Str::lower($search['value']) . "%");
                                    });
                                }
                            })
                            ->addColumn('action', function($row) use ($users) {
                                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Cetak" class="action-cetak btn btn-info btn-sm"><i class="fas fa-print"></i> Cetak</a>';
                                if ($users->role_id != 34) {
                                    $btn .= '<a href="' . url('admin/spt/' . $row->id . '/view') . '" data-toggle="tooltip" data-original-title="View" class="btn btn-success btn-sm"><i class="fas fa-eye"></i> View</a> ';
                                    $btn .= '<a href="' . url('admin/spt/' . $row->id . '/edit') . '" data-toggle="tooltip" data-original-title="Edit" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a> ';
                                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="action-delete btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a> ';
                                    $btn .= '<a href="' . url('admin/spt/' . $row->id . '/pengawas') . '" data-toggle="tooltip" data-original-title="Pengawas" class="btn btn-info btn-sm mt-1"><i class="fas fa-users"></i> Pengawas</a> ';
                                }

                                return $btn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }
    }

    public function submit(Request $request, Spt $spt) {
        $validator = \Validator::make($request->all(), [
                    'no_idx' => ['required', 'unique:sim_spt,no_idx,' . $request->id],
                    'uraian' => ['required', 'string'],
                    'keperluan' => ['required', 'string'],
                    'tgl_spt' => ['required', 'date_format:Y-m-d'],
                    'city_code' => ['required', 'string'],
        ]);

        $users = Auth::user();
        if ($validator->fails()) {
            return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->toArray()
                            ], 422);
        }

        $input['no_idx'] = $request->no_idx;
        $input['uraian'] = $request->uraian;
        $input['city_code'] = $request->city_code;
        $input['tgl_spt'] = $request->tgl_spt;
        $input['keperluan'] = $request->keperluan;
        if ($request->has('id')) {
            $input['updated_at'] = date('Y-m-d H:i:s');
            $input['updated_by'] = $users->id;
            Spt::where('id', $request->id)
                    ->update($input);
            return response()->json([
                        'success' => true,
                        'message' => 'SPT Berhasil update',
            ]);
        } else {
            $input['created_at'] = date('Y-m-d H:i:s');
            $input['created_by'] = $users->id;
            $spt->storeData($input);
        }
        return response()->json([
                    'success' => true,
                    'message' => 'SPT Berhasil dibuat',
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
        $users = Auth::user();
        $spt = Spt::select(['*'])->where('id', $request->id)->first();

        $biodata = \App\Models\Biodata::select([
                    'sim_biodata.id',
                    'sim_biodata.name',
                    'sim_biodata.nip',
                    'm_jabatan.name AS jabatan_name',
                    'm_pangkat.name AS pangkat_name',
                    'm_golongan.name AS golongan_name'
                ])
                ->leftJoin('m_jabatan', 'm_jabatan.jabatan_code', '=', 'sim_biodata.jabatan_code')
                ->leftJoin('m_pangkat', 'm_pangkat.pangkat_code', '=', 'sim_biodata.pangkat_code')
                ->leftJoin('m_golongan', 'm_golongan.golongan_code', '=', 'sim_biodata.golongan_code')
                ->Join('sim_spt_biodata', 'sim_spt_biodata.biodata_id', '=', 'sim_biodata.id')
                ->where('sim_spt_biodata.spt_id', $request->id)
                ->get();
//        $template = DB::table('m_templates')->first();
        $pdf = PDF::loadView('spt.cetak', [
//                    'template' => $template,
//                    'spt' => [
//                        'no_idx' => '172361973612983'
//                    ],
                    'spt' => $spt,
                    'nomor_idx' => '127361978362',
                    'users' => $users,
                    'petugas' => $biodata
                        ], [], $configs);
        $slug = Str::slug($spt->no_idx, '-');
        $filename = 'spt_' . $slug . '.pdf';
        $pdf->save(public_path('pdf/spt/' . $filename));
        $response = [
            'status' => 'success',
            'data' => [
                'url' => URL::to('pdf/spt/' . $filename)
            ]
        ];
        return response()->json($response);
    }

    public function pengawas($id) {
        $biodata = \App\Models\Biodata::select([
                    'sim_biodata.id',
                    'sim_biodata.name',
                    'sim_biodata.nip',
                    'm_jabatan.name AS jabatan_name',
                    'm_pangkat.name AS pangkat_name',
                    'm_golongan.name AS golongan_name',
                    DB::raw('count( sim_spt_biodata.id ) AS ttl_comp')
                ])
                ->leftJoin('m_jabatan', 'm_jabatan.jabatan_code', '=', 'sim_biodata.jabatan_code')
                ->leftJoin('m_pangkat', 'm_pangkat.pangkat_code', '=', 'sim_biodata.pangkat_code')
                ->leftJoin('m_golongan', 'm_golongan.golongan_code', '=', 'sim_biodata.golongan_code')
                ->leftJoin('sim_spt_biodata', function($join) use($id) {
                    $join->on('sim_spt_biodata.biodata_id', '=', 'sim_biodata.id');
                    $join->on('sim_spt_biodata.spt_id', '=', DB::raw($id));
                })
                ->groupBy(DB::raw('sim_biodata.id,
                    sim_biodata.name,
                    sim_biodata.nip,
                    m_jabatan.name,
                    m_pangkat.name,
                    m_golongan.name')
                )
                ->orderBy(DB::raw('count( sim_spt_biodata.id )'), 'desc')
                ->get();
        $spt = Spt::select(['sim_spt.*'])->where('id', $id)->first();
        return View('spt.pengawas', [
            'biodata' => $biodata,
            'spt' => $spt
        ]);
    }

    public function pegawai(Request $request) {
        $users = Auth::user();
        if ($request->status == 'checked') {
            DB::table('sim_spt_biodata')->insert([
                'biodata_id' => $request->biodata_id,
                'spt_id' => $request->spt_id,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        } elseif ($request->status == 'unchecked') {
            DB::table('sim_spt_biodata')
                    ->where('biodata_id', '=', $request->biodata_id)
                    ->where('spt_id', '=', $request->spt_id)
                    ->delete();
        }

        return response()->json([
                    'success' => true,
                    'message' => 'Pendaftaran PJK3 Berhasil',
        ]);
    }

    public function destroy($id) {
        Spt::find($id)->delete();
        return response()->json(['success' => true]);
    }

    public function template(Request $request) {
        $spt = DB::table('m_templates')->first();
        if ($request->flag == 'simpan') {
            if ($request->id) {
                DB::table('m_templates')
                        ->where('id', $request->id)
                        ->update(['content' => $request->content]);
            } else {
                DB::table('m_templates')->insert([
                    'content' => $request->content
                ]);
            }
            return response()->json([
                        'success' => true,
                        'message' => 'Pendaftaran PJK3 Berhasil',
            ]);
        }
        return View('spt.template', [
            'spt' => $spt
        ]);
    }

}
