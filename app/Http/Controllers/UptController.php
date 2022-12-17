<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Upt;
use Illuminate\Support\Str;
use Auth;
use DB;
use App\Models\Company;

/**
 * Description of UptController
 *
 * @author heryhandoko
 */
class UptController extends Controller {

    //put your code here
    public function index() {
        return View('upt.index');
    }

    public function fetch(Request $request) {
        if ($request->ajax()) {
            $data = Upt::select(['m_upt.id', 'm_upt.name',
                        DB::raw('count(DISTINCT sim_user_upt.id) as ttl_pegawai'),
                        DB::raw('count(DISTINCT sim_upt_company.id) as ttl_comp')])
                    ->leftJoin('sim_user_upt', 'm_upt.id', '=', 'sim_user_upt.upt_id')
                    ->leftJoin('sim_upt_company', 'm_upt.id', '=', 'sim_upt_company.upt_id')
                    ->groupByRaw('m_upt.id,m_upt.name');
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->filter(function ($instance) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $instance->where(function($w) use($request) {
                                        $search = $request->get('search');
                                        $w->orWhere('name', 'LIKE', "%" . Str::lower($search['value']) . "%");
                                    });
                                }
                            })
                            ->addColumn('action', function($row) {
                                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="action-view btn btn-primary btn-sm"><i class="fas fa-folder"></i> View</a> ';
                                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="action-edit btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a> ';
                                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="action-delete btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a> ';
                                $btn .= '<a href="' . url('/admin/upt/' . $row->id . '/pegawai') . '" data-toggle="tooltip" data-original-title="Pengawas" class="btn btn-warning btn-sm mt-1"><i class="fas fa-users"></i> Pegawai</a> ';
                                $btn .= '<a href="' . url('admin/upt/' . $row->id . '/company') . '" data-toggle="tooltip" data-original-title="Perusahaan" class="btn btn-success btn-sm mt-1"><i class="fas fa-building"></i> Perusahaan</a> ';
                                return $btn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }
    }

    public function edit($id) {
        $Users = Upt::find($id);
        return response()->json($Users);
    }

    public function update(Request $request, Upt $datapost) {
        $validator = \Validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->toArray()
                            ], 422);
        }

        $user = Auth::user();
        $input = [
            'name' => $request->name,
        ];
        if ($request->id) {
            $input['updated_at'] = date('Y-m-d H:i:s');
            $input['updated_by'] = $user->id;
            Upt::where('id', $request->id)->update($input);
            $status = 'update';
        } else {
            $input['created_at'] = date('Y-m-d H:i:s');
            $input['created_by'] = $user->id;
            $status = 'insert';
            $datapost->storeData($input);
        }
        return response()->json([
                    'success' => true,
                    'message' => 'Update user success',
        ]);
    }

    public function destroy($id) {
        Upt::find($id)->delete();
        return response()->json(['success' => true]);
    }

    public function pegawai($id) {
        $biodata = \App\Models\Biodata::select([
                    'sim_biodata.id',
                    'sim_biodata.name',
                    'sim_biodata.nip',
                    'm_jabatan.name AS jabatan_name',
                    'm_pangkat.name AS pangkat_name',
                    'm_golongan.name AS golongan_name',
                    DB::raw('count(sim_user_upt.id ) AS ttl_comp')
                ])
                ->leftJoin('m_jabatan', 'm_jabatan.jabatan_code', '=', 'sim_biodata.jabatan_code')
                ->leftJoin('m_pangkat', 'm_pangkat.pangkat_code', '=', 'sim_biodata.pangkat_code')
                ->leftJoin('m_golongan', 'm_golongan.golongan_code', '=', 'sim_biodata.golongan_code')
                ->leftJoin('sim_user_upt', function($join) use($id) {
                    $join->on('sim_user_upt.biodata_id', '=', 'sim_biodata.id');
                    $join->on('sim_user_upt.upt_id', '=', DB::raw($id));
                })
                ->groupBy(DB::raw('sim_biodata.id,
                    sim_biodata.name,
                    sim_biodata.nip,
                    m_jabatan.name,
                    m_pangkat.name,
                    m_golongan.name')
                )
                ->orderBy(DB::raw('count( sim_user_upt.id )'), 'desc')
                ->get();
        $company = Upt::select(['m_upt.*'])->where('id', $id)->first();
        return View('upt.pengawas', [
            'biodata' => $biodata,
            'company' => $company
        ]);
    }

    public function anggota(Request $request) {
        $users = Auth::user();
        if ($request->status == 'checked') {
            DB::table('sim_user_upt')->insert([
                'biodata_id' => $request->biodata_id,
                'upt_id' => $request->upt_id,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $users->id
            ]);
        } elseif ($request->status == 'unchecked') {
            DB::table('sim_user_upt')
                    ->where('biodata_id', '=', $request->biodata_id)
                    ->where('upt_id', '=', $request->upt_id)
                    ->delete();
        }

        return response()->json([
                    'success' => true,
                    'message' => 'Pendaftaran PJK3 Berhasil',
        ]);
    }

    public function company($id) {
        $biodata = Upt::find($id);
        return View('upt.company', [
            'biodata' => $biodata,
            'id' => $id
        ]);
    }

    public function fcomp($id, Request $request) {
        if ($request->ajax()) {
            $data = Company::select(['m_company.id', 'm_company.name',
                        'm_kelurahan.name AS kel_name',
                        'm_kecamatan.name AS kec_name',
                        'm_kota.name AS city_name',
                        'm_company.logo_path',
                        DB::raw('IFNULL(sim_upt_company.id,0) AS checked')])
                    ->leftJoin('m_kelurahan', 'm_kelurahan.kel_code', '=', 'm_company.kel_code')
                    ->leftJoin('m_kecamatan', 'm_kecamatan.kec_code', '=', 'm_company.kec_code')
                    ->leftJoin('m_kota', 'm_kota.city_code', '=', 'm_company.city_code')
                    ->leftJoin('sim_upt_company', function($join) use($id) {
                        $join->on('sim_upt_company.company_id', '=', 'm_company.id');
                        $join->on('sim_upt_company.upt_id', '=', DB::raw($id));
                    })
                    ->orderBy(DB::raw('IFNULL(sim_upt_company.id,0)'), 'desc');
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->filter(function ($instance) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $instance->where(function($w) use($request) {
                                        $search = $request->get('search');
                                        $w->orWhere('m_company.name', 'LIKE', "%" . Str::lower($search['value']) . "%");
                                        $w->orWhere('m_kelurahan.name', 'LIKE', "%" . Str::lower($search['value']) . "%");
                                        $w->orWhere('m_kecamatan.name', 'LIKE', "%" . Str::lower($search['value']) . "%");
                                        $w->orWhere('m_kota.name', 'LIKE', "%" . Str::lower($search['value']) . "%");
                                    });
                                }
                            })->addColumn('image', function ($artist) {
                                $url = url($artist->logo_path);
                                return '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" />';
                            })
                            ->rawColumns(['image'])
                            ->make(true);
        }
    }

    public function ucomp(Request $request) {
        $users = Auth::user();
        if ($request->status == 'checked') {
            DB::table('sim_upt_company')->insert([
                'upt_id' => $request->biodata_id,
                'company_id' => $request->company_id,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $users->id
            ]);
        } elseif ($request->status == 'unchecked') {
            DB::table('sim_upt_company')
                    ->where('upt_id', '=', $request->biodata_id)
                    ->where('company_id', '=', $request->company_id)
                    ->delete();
        }

        return response()->json([
                    'success' => true,
                    'message' => 'Pendaftaran PJK3 Berhasil',
        ]);
    }

}
