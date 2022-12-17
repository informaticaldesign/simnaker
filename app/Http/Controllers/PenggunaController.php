<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Biodata;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Validation\Rule;
use App\Models\Company;
use DB;

/**
 * Description of PenggunaController
 *
 * @author heryhandoko
 */
class PenggunaController extends Controller {

    //put your code here
    public function index() {
        return View('pengguna.index');
    }

    public function company($id) {
        $biodata = Biodata::find($id);
        return View('pengguna.company', [
            'biodata' => $biodata,
            'id' => $id
        ]);
    }

    public function upt($id) {
        $biodata = Biodata::find($id);
        return View('pengguna.upt', [
            'biodata' => $biodata,
            'id' => $id
        ]);
    }

    public function fcomp($id, Request $request) {
        if ($request->ajax()) {
            $data = Company::select(['m_company.id', 'm_company.name', 'm_company.logo_path', DB::raw('IFNULL(sim_user_company.id,0) AS checked')])
                    ->leftJoin('sim_user_company', function($join) use($id) {
                        $join->on('sim_user_company.company_id', '=', 'm_company.id');
                        $join->on('sim_user_company.biodata_id', '=', DB::raw($id));
                    })
                    ->orderBy(DB::raw('IFNULL(sim_user_company.id,0)'), 'desc');
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->filter(function ($instance) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $instance->where(function($w) use($request) {
                                        $search = $request->get('search');
                                        $w->orWhere('m_company.name', 'LIKE', "%" . Str::lower($search['value']) . "%");
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

    public function fupt($id, Request $request) {
        if ($request->ajax()) {
            $data = \App\Models\Upt::select(['m_upt.id', 'm_upt.name', DB::raw('IFNULL(sim_user_upt.id,0) AS checked')])
                    ->leftJoin('sim_user_upt', function($join) use($id) {
                        $join->on('sim_user_upt.upt_id', '=', 'm_upt.id');
                        $join->on('sim_user_upt.biodata_id', '=', DB::raw($id));
                    })
                    ->orderBy(DB::raw('IFNULL(sim_user_upt.id,0)'), 'desc');
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->filter(function ($instance) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $instance->where(function($w) use($request) {
                                        $search = $request->get('search');
                                        $w->orWhere('m_upt.name', 'LIKE', "%" . Str::lower($search['value']) . "%");
                                    });
                                }
                            })
                            ->make(true);
        }
    }

    public function ucomp(Request $request) {
        $users = Auth::user();
        if ($request->status == 'checked') {
            DB::table('sim_user_company')->insert([
                'biodata_id' => $request->biodata_id,
                'company_id' => $request->company_id,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $users->id
            ]);
        } elseif ($request->status == 'unchecked') {
            DB::table('sim_user_company')
                    ->where('biodata_id', '=', $request->biodata_id)
                    ->where('company_id', '=', $request->company_id)
                    ->delete();
        }

        return response()->json([
                    'success' => true,
                    'message' => 'Pendaftaran PJK3 Berhasil',
        ]);
    }

    public function eupt(Request $request) {
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

    public function fetch(Request $request) {
        if ($request->ajax()) {
            $users = Auth::user();
            $data = Biodata::select([
                        'sim_biodata.id',
                        'sim_biodata.nip',
                        'sim_biodata.name',
                        'm_jabatan.name AS jabatan_name',
                        'm_pangkat.name AS pangkat_name',
                        'm_golongan.name AS golongan_name',
                        DB::raw('count(DISTINCT sim_user_company.id) as ttl_comp'),
                        DB::raw('count(DISTINCT sim_user_upt.id) as ttl_upt')
                    ])
                    ->leftJoin('m_jabatan', 'm_jabatan.jabatan_code', '=', 'sim_biodata.jabatan_code')
                    ->leftJoin('m_pangkat', 'm_pangkat.pangkat_code', '=', 'sim_biodata.pangkat_code')
                    ->leftJoin('m_golongan', 'm_golongan.golongan_code', '=', 'sim_biodata.golongan_code')
                    ->leftJoin('sim_user_company', 'sim_biodata.id', '=', 'sim_user_company.biodata_id')
                    ->leftJoin('sim_user_upt', 'sim_biodata.id', '=', 'sim_user_upt.biodata_id')
                    ->groupByRaw('sim_biodata.id,sim_biodata.nip,sim_biodata.name,m_jabatan.name,m_pangkat.name,m_golongan.name');
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->filter(function ($instance) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $instance->where(function($w) use($request) {
                                        $search = $request->get('search');
                                        $w->orWhere('sim_biodata.name', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                        ->orWhere('sim_biodata.email', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                        ->orWhere('sim_biodata.address', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                        ->orWhere('sim_biodata.phone', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                        ->orWhere('sim_biodata.nip', 'LIKE', "%" . Str::lower($search['value']) . "%");
                                    });
                                }
                            })
                            ->addColumn('action', function($row) use ($users) {
                                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="action-view btn btn-primary btn-sm"><i class="fas fa-folder"></i> View</a> ';
                                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="action-edit btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a> ';
                                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="action-delete btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>';
                                if ($users->role_id == 38 || $users->role_id == 1) {
                                    $btn .= '<a href="' . url('pengguna/' . $row->id . '/company') . '" data-toggle="tooltip" data-original-title="Perusahaan" class="btn btn-success btn-sm mt-1"><i class="fas fa-building"></i> Perusahaan</a> ';
                                    $btn .= '<a href="' . url('pengguna/' . $row->id . '/upt') . '" data-toggle="tooltip" data-original-title="UPT" class="btn btn-warning btn-sm mt-1"><i class="fas fa-clipboard"></i> UPT</a> ';
                                }
                                return $btn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }
    }

    public function edit($id) {
        $Users = Biodata::find($id);
        return response()->json($Users);
    }

    public function update(Request $request, Biodata $datapost) {
        $validator = \Validator::make($request->all(), [
                    'email' => ['required', 'string', 'max:255', Rule::unique('sim_biodata')->ignore($request->pengguna_id)],
                    'name' => ['required', 'string', 'max:255'],
                    'address' => ['required', 'string', 'max:255'],
                    'nip' => ['required', 'string', 'max:21', Rule::unique('sim_biodata')->ignore($request->pengguna_id)],
                    'phone' => ['required', 'string', 'max:255'],
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
            'email' => $request->email,
            'address' => $request->address,
            'nip' => $request->nip,
            'phone' => $request->phone
        ];
        if ($request->pengguna_id) {
            $input['updated_at'] = date('Y-m-d H:i:s');
            $input['updated_by'] = $user->id;
            Biodata::where('id', $request->pengguna_id)->update($input);
            $status = 'update';
        } else {
            $input['created_at'] = date('Y-m-d H:i:s');
            $input['created_by'] = $user->id;
            $input['avatar'] = 'avatar5.png';
            $input['avatar_path'] = 'images/avatar5.png';
            $status = 'insert';
            $datapost->storeData($input);
        }
        return response()->json([
                    'success' => true,
                    'message' => 'Update user success',
        ]);
    }

    public function destroy($id) {
        Biodata::find($id)->delete();
        return response()->json(['success' => true]);
    }

}
