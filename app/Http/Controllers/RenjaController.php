<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Renja;
use App\Models\Biodata;
use App\Exports\RenjaExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Auth;
use URL;
use DB;

//use DataTables;
/**
 * Description of RenjaController
 *
 * @author heryhandoko
 */
class RenjaController extends Controller {

    //put your code here
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $user = Auth::user();
        $company = \App\Models\Company::select(['m_company.name', 'm_company.id'])
                ->join('sim_user_company AS b', 'm_company.id', '=', 'b.company_id')
                ->where('b.user_id', $user->id)
                ->get()
                ->pluck('name', 'id');
        return View('renja.index', [
            'company' => $company
        ]);
    }

    public function event(Request $request) {
        $users = Auth::user();
        $from = substr($request->start, 0, 10);
        $to = substr($request->end, 0, 10);
        $data = Renja::select(['sim_renja.id', 'm_company.name AS title', 'sim_renja.tgl_pelaksanaan AS start', 'sim_renja.tgl_pelaksanaan AS end', 'sim_renja.status', 'sim_renja.color'])
                ->leftJoin('m_company', 'm_company.id', '=', 'sim_renja.company_id')
                ->where('sim_renja.created_by', $users->id)
                ->whereBetween('sim_renja.tgl_pelaksanaan', [$from, $to])
                ->get();
        return response()->json($data);
    }

    public function store(Request $request, Renja $renja) {
        $fieldValidate = [
            'jenis_kegiatan' => ['required', 'string', 'max:500'],
            'company_id' => ['required', 'numeric'],
            'tgl_pelaksanaan' => ['required', 'date_format:Y-m-d'],
            'address' => ['required', 'string', 'max:500'],
        ];
        $validator = \Validator::make($request->all(), $fieldValidate);
        if ($validator->fails()) {
            return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->toArray()
                            ], 422);
        }
        $users = Auth::user();
        $data = Renja::create([
                    'jenis_kegiatan' => $request->jenis_kegiatan,
                    'company_id' => $request->company_id,
                    'keterangan' => $request->keterangan,
                    'tgl_pelaksanaan' => $request->tgl_pelaksanaan,
                    'created_by' => $users->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'status' => 'proses',
                    'color' => '#ffc107'
        ]);
        if ($data->id) {
            return response()->json([
                        'success' => true,
                        'message' => 'Buat Rencana Kerja Berhasil'
            ]);
        } else {
            return response()->json([
                        'success' => false,
                        'message' => 'Buat Rencana Kerja Gagal'
            ]);
        }
    }

    public function address(Request $request) {
        $data = \App\Models\Company::select(['address'])->where('id', $request->id)->first();
        return response()->json(
                        [
                            'success' => true,
                            'data' => $data
                        ], 200);
    }

    public function edit($id) {
        $renja = Renja::select(['sim_renja.*', 'm_company.address'])->join('m_company', 'm_company.id', '=', 'sim_renja.company_id')->find($id);
        return response()->json($renja);
    }

    public function cetak(Request $request) {
        date_default_timezone_set("Asia/Bangkok");
        ini_set('memory_limit', '1024M');
        ini_set('upload_max_filesize', '1024M');
        ini_set('post_max_size', '1024M');
        $configs = [
            'title' => 'Rencana Kerja',
            'format' => 'A4',
            'orientation' => 'L',
            'author' => '',
            'watermark' => '',
            'show_watermark' => false,
            'show_watermark_image' => false,
        ];

        $users = Auth::user();
        $biodata = Biodata::select([
                    'a.id',
                    'a.name',
                    'a.nip',
                    'b.name AS golongan',
                    'c.name AS pangkat',
                    'd.name AS jabatan'
                ])
                ->from('sim_biodata AS a')
                ->leftJoin('m_golongan AS b', 'b.id', '=', 'a.id_golongan')
                ->leftJoin('m_pangkat AS c', 'c.id', '=', 'a.id_pangkat')
                ->leftJoin('m_jabatan AS d', 'd.id', '=', 'a.id_jabatan')
                ->where('a.id', $users->biodata_id)
                ->first();
        $renja = Renja::select([
                    'sim_renja.id',
                    'sim_renja.jenis_kegiatan',
                    'm_company.name AS perusahaan',
                    'm_company.address AS alamat',
                    'sim_renja.tgl_pelaksanaan',
                    'sim_renja.keterangan'
                ])
                ->leftJoin('m_company', 'm_company.id', '=', 'sim_renja.company_id')
                ->where('sim_renja.created_by', $users->id)
                ->whereYear('sim_renja.tgl_pelaksanaan', $request->y)
                ->whereMonth('sim_renja.tgl_pelaksanaan', $request->m)
                ->get();
        $pdf = PDF::loadView('renja.cetak', [
                    'users' => $users,
                    'biodata' => $biodata,
                    'renja' => $renja,
                    'month' => str_pad($request->m, 2, "0", STR_PAD_LEFT),
                    'year' => $request->y
                        ], [], $configs);
        $filename = 'renja_' . $users->id . '_' . $request->m . '_' . $request->y . '.pdf';
        $pdf->save(public_path('pdf/renja/' . $filename));
        $response = [
            'status' => 'success',
            'data' => [
                'url' => URL::to('pdf/renja/' . $filename)
            ]
        ];
        return response()->json($response);
    }

    public function export_excel(Request $request) {
        $users = Auth::user();
        $filename = 'renja_' . $users->id . '_' . $request->m . '_' . $request->y . '.xls';
        return Excel::download(new RenjaExport($request), $filename);
    }

    public function chartbar() {

        $proses = DB::table('sys_month')
                ->leftJoin('sim_renja', function ($join) {
                    $user = Auth::user();
                    $join->on(DB::raw('MONTH(sim_renja.tgl_pelaksanaan)'), '=', 'sys_month.id')
                    ->where('sim_renja.created_by', '=', $user->id)
                    ->where('sim_renja.status', 'disetujui')
                    ->whereYear('sim_renja.tgl_pelaksanaan', date('Y'));
                })
                ->select(DB::raw('sys_month.id,sys_month.code,COUNT(sim_renja.id) AS total'))
                ->groupBy('sys_month.id', 'sys_month.code')
                ->get();

        $pengajuan = DB::table('sys_month')
                ->leftJoin('sim_renja', function ($join) {
                    $user = Auth::user();
                    $join->on(DB::raw('MONTH(sim_renja.tgl_pelaksanaan)'), '=', 'sys_month.id')
                    ->where('sim_renja.created_by', '=', $user->id)
                    ->where('sim_renja.status', 'proses')
                    ->whereYear('sim_renja.tgl_pelaksanaan', date('Y'));
                })
                ->select(DB::raw('sys_month.id,sys_month.code,COUNT(sim_renja.id) AS total'))
                ->groupBy('sys_month.id', 'sys_month.code')
                ->get();

        $terverifikasi = DB::table('sys_month')
                ->leftJoin('sim_renja', function ($join) {
                    $user = Auth::user();
                    $join->on(DB::raw('MONTH(sim_renja.tgl_pelaksanaan)'), '=', 'sys_month.id')
                    ->where('sim_renja.created_by', '=', $user->id)
                    ->where('sim_renja.status', 'ditolak')
                    ->whereYear('sim_renja.tgl_pelaksanaan', date('Y'));
                })
                ->select(DB::raw('sys_month.id,sys_month.code,COUNT(sim_renja.id) AS total'))
                ->groupBy('sys_month.id', 'sys_month.code')
                ->get();

        $bulan = [];
        $bbn1 = [];
        $bbn2 = [];
        $bbn3 = [];
        foreach ($proses as $key => $val) {
            $bulan[] = $val->code;
            $bbn1[] = $proses[$key]->total;
            $bbn2[] = $pengajuan[$key]->total;
            $bbn3[] = $terverifikasi[$key]->total;
        }
        return response()->json([
                    'success' => true,
                    'data' => [
                        'labels' => $bulan,
                        'datasets2' => [
                            [
                                'data' => $bbn1,
                                'backgroundColor' => '#28a745',
                                'borderColor' => '#28a745',
                            ],
                            [
                                'data' => $bbn2,
                                'backgroundColor' => '#ffc107',
                                'borderColor' => '#ffc107',
                            ],
                            [
                                'data' => $bbn3,
                                'backgroundColor' => '#dc3545',
                                'borderColor' => '#dc3545',
                            ]
                        ]
                    ]
        ]);
    }

    public function chartpie() {
        $user = Auth::user();
        $dataR1 = DB::table('sim_renja')
                ->select(DB::raw('sim_renja.status,COUNT(sim_renja.id) AS total'))
                ->where('sim_renja.created_by', '=', $user->id)
                ->whereYear('sim_renja.tgl_pelaksanaan', date('Y'))
                ->groupBy('sim_renja.status')
                ->get();
        $labels = [];
        $status = [];
        foreach ($dataR1 as $key => $val) {
            $labels[] = $val->status;
            $status[] = $val->total;
        }
        return response()->json([
                    'success' => true,
                    'data' => [
                        'labels' => $labels,
                        'status' => $status
                    ]
        ]);
    }

}
