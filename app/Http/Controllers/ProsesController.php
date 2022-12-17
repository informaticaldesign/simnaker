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
use DB;
/**
 * Description of PengajuanController
 *
 * @author heryhandoko
 */
class ProsesController {

    //put your code here
    public function index() {
        return View('pjk3.proses.index');
    }
    
    public function create($step, $id) {
        $data = [];
        if ($id != '0') {
            $data = Suket::select(['*'])->where('id', Crypt::decrypt($id))->first();
        }
        $users = Auth::user();
        if ($step == 1) {
            return View('pjk3.proses.create', [
                'step' => $step,
                'id' => $id,
                'data' => $data
            ]);
        } elseif ($step == 2) {
            return View('pjk3.proses.createx', [
                'step' => $step,
                'id' => $id,
                'data' => $data
            ]);
        } elseif ($step == 3) {
            if ($users->role_id == 35) {
                $companies = \App\Models\Company::where('status', 1)
                        ->where('comp_type', 'company')
                        ->where('created_by', $users->id)
                        ->pluck('name', 'id');
            } elseif ($users->role_id == 38 || $users->role_id == 34 || $users->role_id == 39) {
                $companies = \App\Models\Company::where('status', 1)
                        ->where('comp_type', 'company')
                        ->where('id', $data->company_id)
                        ->pluck('name', 'id');
            }
            return View('pjk3.proses.createxx', [
                'step' => $step,
                'id' => $id,
                'data' => $data,
                'companies' => $companies,
            ]);
        } elseif ($step == 4) {
            return View('pjk3.proses.createxxx', [
                'step' => $step,
                'id' => $id,
                'data' => $data,
                'users' => $users,
                'preview' => true
            ]);
        } elseif ($step == 5) {
            $pemeriksaan = \App\Models\Jenispem::pluck('name', 'id');
            $types = \App\Models\Typepem::pluck('name', 'id');
            return View('pjk3.proses.createxxxx', [
                'step' => $step,
                'id' => $id,
                'data' => $data,
                'pemeriksaan' => $pemeriksaan,
                'types' => $types,
                'users' => $users,
                'preview' => true
            ]);
        } elseif ($step == 6) {
            if ($data->status == 'terkirim') {
                $biodata = \App\Models\Biodata::select([
                            'sim_biodata.*',
                            'm_jabatan.name AS jabatan_name',
                            'm_pangkat.name AS pangkat_name',
                            'm_golongan.name AS golongan_name'
                        ])
                        ->leftJoin('m_jabatan', 'm_jabatan.jabatan_code', '=', 'sim_biodata.jabatan_code')
                        ->leftJoin('m_pangkat', 'm_pangkat.pangkat_code', '=', 'sim_biodata.pangkat_code')
                        ->leftJoin('m_golongan', 'm_golongan.golongan_code', '=', 'sim_biodata.golongan_code')
                        ->get();
            } elseif ($data->status == 'proses') {
                $upt = DB::table('sim_user_upt')->where('biodata_id',$data->biodata_upt_id)->first();
                $biodata = \App\Models\Biodata::select([
                    'sim_biodata.*',
                    'm_jabatan.name AS jabatan_name',
                    'm_pangkat.name AS pangkat_name',
                    'm_golongan.name AS golongan_name'
                ])
                ->leftJoin('m_jabatan', 'm_jabatan.jabatan_code', '=', 'sim_biodata.jabatan_code')
                ->leftJoin('m_pangkat', 'm_pangkat.pangkat_code', '=', 'sim_biodata.pangkat_code')
                ->leftJoin('m_golongan', 'm_golongan.golongan_code', '=', 'sim_biodata.golongan_code')
                ->join('sim_user_upt','sim_user_upt.biodata_id','=','sim_biodata.id')
                ->where('sim_user_upt.biodata_id','!=',$data->biodata_upt_id)
                ->where('sim_user_upt.upt_id',$upt->upt_id)
                // ->join('users', 'users.biodata_id', '=', 'sim_biodata.id')
                // ->where('users.role_id', 34) // 39 role kepala UPT
                ->get();

                // $biodata = \App\Models\Biodata::select([
                //             'sim_biodata.*',
                //             'm_jabatan.name AS jabatan_name',
                //             'm_pangkat.name AS pangkat_name',
                //             'm_golongan.name AS golongan_name'
                //         ])
                //         ->leftJoin('m_jabatan', 'm_jabatan.jabatan_code', '=', 'sim_biodata.jabatan_code')
                //         ->leftJoin('m_pangkat', 'm_pangkat.pangkat_code', '=', 'sim_biodata.pangkat_code')
                //         ->leftJoin('m_golongan', 'm_golongan.golongan_code', '=', 'sim_biodata.golongan_code')
                //         ->join('sim_bio_comp_suket', function($join) use ($data) {
                //             $join->on('sim_bio_comp_suket.biodata_id', '=', 'sim_biodata.id');
                //             $join->on('sim_bio_comp_suket.suket_id', '=', DB::raw($data->id));
                //         })
                //         ->get();
            }
            return View('pjk3.proses.createxxxxx', [
                'step' => $step,
                'id' => $id,
                'data' => $data,
                'users' => $users,
                'biodata' => $biodata
            ]);
        }
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
                    ->where('a.status', 'proses');
            if ($users->role_id == 35) {
                $data->where('a.created_by', $users->id);
            }elseif ($users->role_id == 39) {
                // 39 role kepala upt 
                $data->where('a.status', 'proses');
                $data->where('biodata_upt_id',$users->biodata_id);
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
                            ->addColumn('status', function($row) use ($users)  {
                                if ($row->status == 'draft') {
                                    $btn = '<small class="badge badge-info">Konsep</small>';
                                } elseif ($row->status == 'proses') {
                                    if ($users->role_id == 38) {
                                        $btn = '<small class="badge badge-warning">Proses di UPT</small>';
                                    }else{
                                        $btn = '<small class="badge badge-warning">Proses</small>';
                                    }
                                } else {
                                    $btn = '<small class="badge badge-success">Terverifikasi</small>';
                                }
                                return $btn;
                            })
                            ->addColumn('action', function($row) use ($users) {
                                $id = Crypt::encrypt($row->id);
                                $btn = '';
                                if ($users->role_id == 38) {
                                    // role untuk kepala bidang
                                    // $btn = '<a href="' . url('admin/proses/create/1/' . $id) . '" data-toggle="tooltip"  data-id="' . $id . '" data-original-title="Verifikasi" class="btn action-edit btn-success btn-sm mr-1"><i class="fas fa-pencil-alt"></i>&nbsp;Verifikasi</a> ';
                                    // $btn = '<a href="' . url('admin/proses/create/1/' . $id) . '" data-toggle="tooltip"  data-id="' . $id . '" data-original-title="Verifikasi" class="btn action-edit btn-success btn-sm mr-1"><i class="fas fa-pencil-alt"></i>&nbsp;Verifikasi</a> ';
                                } elseif ($users->role_id == 39) {
                                    // role untuk kepala upt
                                    $btn = '<a href="' . url('admin/proses/create/1/' . $id) . '" data-toggle="tooltip"  data-id="' . $id . '" data-original-title="Proses" class="btn action-edit btn-warning btn-sm mr-1"><i class="fas fa-pencil-alt"></i>&nbsp;Proses</a> ';
                                } else {
                                    if ($row->status == 'draft') {
                                        $btn = '<a href="' . url('admin/proses/create/1/' . $id) . '" data-toggle="tooltip"  data-id="' . $id . '" data-original-title="Edit" class="action-edit mr-1"><i class="fas fa-pencil-alt text-warning"></i></a> ';
                                        $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $id . '" data-original-title="Delete" class="action-delete"><i class="fas fa-trash text-danger"></i></a>';
                                    } else {
                                        $btn = '<a href="' . url('admin/proses/create/1/' . $id) . '" data-toggle="tooltip"  data-id="' . $id . '" data-original-title="View" class="action-view mr-1 btn btn-sm btn-info"><i class="fas fa-eye"></i>&nbsp; Detail</a> ';
                                    }
                                }
                                return $btn;
                            })
                            ->rawColumns(['status', 'action'])
                            ->orderColumn('no_surat', 'no_surat $1')
                            ->make(true);
        }
    }

}
