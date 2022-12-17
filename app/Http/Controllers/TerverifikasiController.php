<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Suket;
use DataTables;
use Auth;

/**
 * Description of PengajuanController
 *
 * @author heryhandoko
 */
class TerverifikasiController {

    //put your code here
    public function index() {
        return View('pjk3.terverifikasi.index');
    }

    public function fetch(Request $request) {
        if ($request->ajax()) {
            $users = Auth::user();
            $data = Suket::select(['a.id',
                        'a.no_surat',
                        'a.tgl_surat',
                        'a.status',
                        'a.company_id',
                        'b.name AS company_name',
                        'a.step',
                    ])
                    ->from('sim_suket AS a')
                    ->leftJoin('m_company AS b', 'b.id', '=', 'a.company_id')
                    ->where('a.status', 'terverifikasi');
            if ($users->role_id == 35) {
                $data->where('a.created_by', $users->id);
            }

            return DataTables::of($data)
                            ->addIndexColumn()
                            ->filter(function ($instance) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $instance->where(function($w) use($request) {
                                        $search = $request->get('search');
                                        $w->orWhere('a.no_surat', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                        ->orWhere('a.status', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                        ->orWhere('a.tgl_surat', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                        ->orWhere('b.name', 'LIKE', "%" . Str::lower($search['value']) . "%");
                                    });
                                }
                            })
                            ->addColumn('status', function($row) {
                                if ($row->status == 'draft') {
                                    $btn = '<small class="badge badge-info">Konsep</small>';
                                } elseif ($row->status == 'proses') {
                                    $btn = '<small class="badge badge-warning">Proses</small>';
                                } else {
                                    $btn = '<small class="badge badge-success">Terverifikasi</small>';
                                }
                                return $btn;
                            })
                            ->addColumn('action', function($row) {
                                $id = Crypt::encrypt($row->id);
                                if ($row->status == 'draft') {
                                    $btn = '<a href="' . url('admin/pengajuan/create/1/' . $id) . '" data-toggle="tooltip"  data-id="' . $id . '" data-original-title="Edit" class="action-edit mr-1"><i class="fas fa-pencil-alt text-warning"></i></a> ';
                                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $id . '" data-original-title="Delete" class="action-delete"><i class="fas fa-trash text-danger"></i></a>';
                                } else {
                                    $btn = '<a href="' . url('admin/pengajuan/create/1/' . $id) . '" data-toggle="tooltip"  data-id="' . $id . '" data-original-title="View" class="action-view mr-1"><i class="fas fa-eye text-info"></i></a> ';
                                }
                                return $btn;
                            })
                            ->rawColumns(['status', 'action'])
                            ->orderColumn('no_surat', 'no_surat $1')
                            ->make(true);
        }
    }

}
