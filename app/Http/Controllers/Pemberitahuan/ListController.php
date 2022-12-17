<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Pemberitahuan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use App\Models\Pemberitahuan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use PDF;
use URL;
use Auth;

/**
 * Description of ListController
 *
 * @author heryhandoko
 */
class ListController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    //put your code here
    public function index() {
        return View('pemberitahuan.list.index');
    }

    public function fetch(Request $request) {
        if ($request->ajax()) {
            $users = Auth::user();
            $data = Pemberitahuan::select(['sim_pemberitahuan.*', 'm_company.name AS company_name'])
                    ->Join('sim_renja', 'sim_renja.id', '=', 'sim_pemberitahuan.renja_id')
                    ->Join('m_company', 'm_company.id', '=', 'sim_renja.company_id')
                    ->where('sim_pemberitahuan.created_by', $users->id);
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->filter(function ($instance) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $instance->where(function($w) use($request) {
                                        $search = $request->get('search');
                                        $w->orWhere('no_idx', 'LIKE', "%" . Str::lower($search['value']) . "%");
                                    });
                                }
                            })
                            ->addColumn('tgl_notif', function($row) {
                                return Carbon::parse($row->tgl_notif)->locale('id')->isoFormat('D MMMM Y');
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
                                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Cetak" class="action-cetak btn btn-warning btn-sm"><i class="fas fa-print"></i></a> ';
                                $btn .= '<a href="' . url('pemberitahuan/list/view' . '/' . $row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="action-view btn btn-primary btn-sm"><i class="fas fa-eye"></i></a> ';
                                return $btn;
                            })
                            ->rawColumns(['status', 'action', 'tgl_notif'])
                            ->make(true);
        }
    }

    public function view($id) {
        $notif = Pemberitahuan::where('id', $id)->first();
        $biodata = \App\Models\Biodata::select([
                    'a.id',
                    'a.name',
                    'a.nip',
                    'a.phone',
                    'b.name AS golongan',
                    'c.name AS pangkat',
                    'd.name AS jabatan'
                ])
                ->from('sim_biodata AS a')
                ->leftJoin('m_golongan AS b', 'b.golongan_code', '=', 'a.golongan_code')
                ->leftJoin('m_pangkat AS c', 'c.pangkat_code', '=', 'a.pangkat_code')
                ->leftJoin('m_jabatan AS d', 'd.jabatan_code', '=', 'a.jabatan_code')
                ->leftJoin('users AS e', 'e.biodata_id', '=', 'a.id')
                ->where('e.id', $notif->created_by)
                ->first();
        $renja = \App\Models\Renja::select([
                    'sim_renja.id',
                    'sim_renja.jenis_kegiatan',
                    'sim_renja.type_kegiatan',
                    'sim_renja.tgl_pelaksanaan',
                    'm_company.name AS perusahaan',
                    'm_company.address AS alamat',
                    'sim_renja.tgl_pelaksanaan',
                    'sim_renja.keterangan'
                ])
                ->leftJoin('m_company', 'm_company.id', '=', 'sim_renja.company_id')
                ->where('sim_renja.id', $notif->renja_id)
                ->first();
        return View('pemberitahuan.list.view', [
            'notif' => $notif,
            'biodata' => $biodata,
            'renja' => $renja
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
        $id = $request->id;
        $notif = Pemberitahuan::where('id', $id)->first();
        $biodata = \App\Models\Biodata::select([
                    'a.id',
                    'a.name',
                    'a.nip',
                    'a.phone',
                    'b.name AS golongan',
                    'c.name AS pangkat',
                    'd.name AS jabatan'
                ])
                ->from('sim_biodata AS a')
                ->leftJoin('m_golongan AS b', 'b.golongan_code', '=', 'a.golongan_code')
                ->leftJoin('m_pangkat AS c', 'c.pangkat_code', '=', 'a.pangkat_code')
                ->leftJoin('m_jabatan AS d', 'd.jabatan_code', '=', 'a.jabatan_code')
                ->leftJoin('users AS e', 'e.biodata_id', '=', 'a.id')
                ->where('e.id', $notif->created_by)
                ->first();
        $renja = \App\Models\Renja::select([
                    'sim_renja.id',
                    'sim_renja.jenis_kegiatan',
                    'sim_renja.type_kegiatan',
                    'sim_renja.tgl_pelaksanaan',
                    'm_company.name AS perusahaan',
                    'm_company.address AS alamat',
                    'sim_renja.tgl_pelaksanaan',
                    'sim_renja.keterangan'
                ])
                ->leftJoin('m_company', 'm_company.id', '=', 'sim_renja.company_id')
                ->where('sim_renja.id', $notif->renja_id)
                ->first();

        $pdf = PDF::loadView('pemberitahuan.list.cetak', [
                    'notif' => $notif,
                    'biodata' => $biodata,
                    'renja' => $renja
                        ], [], $configs);
        $slug = Str::slug($notif->no_idx, '-');
        $filename = 'surat_pemberitahuan_' . $slug . '.pdf';
        $pdf->save(public_path('pdf/spt/' . $filename));
        $response = [
            'status' => 'success',
            'data' => [
                'url' => URL::to('pdf/spt/' . $filename)
            ]
        ];
        return response()->json($response);
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
        Pemberitahuan::where('id', $request->id)->update(['uraian' => $request->description]);
        return response()->json([
                    'success' => true,
                    'message' => 'Description Berhasil diupdate',
        ]);
    }

}
