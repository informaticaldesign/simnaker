<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Company;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use Auth;
use File;
use DB;

/**
 * Description of CompanyController
 *
 * @author heryhandoko
 */
class CompanyController extends Controller {

    //put your code here
    public function index() {
        $provinsis = \App\Models\Provinsi::pluck('name', 'id');
        $kotas = \App\Models\Kota::pluck('name', 'id');
        return View('company.index', [
            'provinsis' => $provinsis,
            'kotas' => $kotas,
            'comp_type' => 'company'
        ]);
    }

    public function agent() {
        $provinsis = \App\Models\Provinsi::pluck('name', 'id');
        $kotas = \App\Models\Kota::pluck('name', 'id');
        return View('company.index', [
            'provinsis' => $provinsis,
            'kotas' => $kotas,
            'comp_type' => 'agent'
        ]);
    }

    public function pengawas($id) {
        $biodata = \App\Models\Biodata::select([
                    'sim_biodata.id',
                    'sim_biodata.name',
                    'sim_biodata.nip',
                    'm_jabatan.name AS jabatan_name',
                    'm_pangkat.name AS pangkat_name',
                    'm_golongan.name AS golongan_name',
                    DB::raw('count( sim_user_company.id ) AS ttl_comp')
                ])
                ->leftJoin('m_jabatan', 'm_jabatan.jabatan_code', '=', 'sim_biodata.jabatan_code')
                ->leftJoin('m_pangkat', 'm_pangkat.pangkat_code', '=', 'sim_biodata.pangkat_code')
                ->leftJoin('m_golongan', 'm_golongan.golongan_code', '=', 'sim_biodata.golongan_code')
                ->leftJoin('sim_user_company', function($join) use($id) {
                    $join->on('sim_user_company.biodata_id', '=', 'sim_biodata.id');
                    $join->on('sim_user_company.company_id', '=', DB::raw($id));
                })
                ->groupBy(DB::raw('sim_biodata.id,
                    sim_biodata.name,
                    sim_biodata.nip,
                    m_jabatan.name,
                    m_pangkat.name,
                    m_golongan.name')
                )
                ->orderBy(DB::raw('count( sim_user_company.id )'), 'desc')
                ->get();
        $company = Company::select(['m_company.*'])->where('id', $id)->first();
        return View('company.pengawas', [
            'biodata' => $biodata,
            'company' => $company
        ]);
    }

    public function create() {
        $users = Auth::user();
        $user = $users->name;
        $provinsis = \App\Models\Provinsi::pluck('name', 'prov_code AS id');
        $kotas = \App\Models\Kota::pluck('name', 'city_code AS id');
        $jeniss = \App\Models\Jenisusaha::pluck('name', 'id');
        $bidangs = \App\Models\Bidangusaha::pluck('name', 'id');
        $sektors = \App\Models\Sektor::pluck('name', 'sektor_code AS id');
        return view('company.create', [
            'provinsis' => $provinsis,
            'kotas' => $kotas,
            'jeniss' => $jeniss,
            'bidangs' => $bidangs,
            'sektors' => $sektors,
            'user' => $user
        ]);
    }

    public function fetch(Request $request) {
        if ($request->ajax()) {
            if ($request->comp_type == 'agent') {
                $data = Company::select(['a.id', 'a.name', 'a.logo_path', DB::raw('count(c.id) as ttl_pengawas')])
                        ->from('m_company AS a')
                        ->leftJoin('users AS b', 'b.company_id', '=', 'a.id')
                        ->leftJoin('m_company AS c', 'c.created_by', '=', 'b.id')
                        ->where('a.comp_type', $request->comp_type)
                        ->where('a.status', DB::raw(1))
                        ->groupByRaw('a.id,a.name,a.logo_path');
                $users = Auth::user();
                if ($users->role_id == '35') {
                    $data->where('a.created_by', $users->id);
                }
                return DataTables::of($data)
                                ->addIndexColumn()
                                ->filter(function ($instance) use ($request) {
                                    if (!empty($request->get('search'))) {
                                        $instance->where(function($w) use($request) {
                                            $search = $request->get('search');
                                            $w->orWhere('a.name', 'LIKE', "%" . Str::lower($search['value']) . "%");
                                        });
                                    }
                                })->addColumn('image', function ($artist) {
                                    $url = url($artist->logo_path);
                                    return '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" />';
                                })
                                ->addColumn('action', function($row) use ($users) {
                                    $btn = '<a href="' . url('company/' . $row->id . '/view') . '" data-toggle="tooltip" data-original-title="View" class="btn btn-success btn-sm"><i class="fas fa-eye"></i> View</a> ';
//                                    $btn .= '<a href="' . url('company/' . $row->id . '/ubah') . '" data-toggle="tooltip" data-original-title="Edit" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a> ';
//                                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="action-delete btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a> ';
                                    if ($users->role_id == 38 || $users->role_id == 1) {
                                        $btn .= '<a href="' . url('company/' . $row->id . '/anggota') . '" data-toggle="tooltip" data-original-title="Pengawas" class="btn btn-info btn-sm"><i class="fas fa-building"></i> Perusahaan</a> ';
                                    }
                                    return $btn;
                                })
                                ->rawColumns(['image', 'action'])
                                ->make(true);
            } else {
                $data = Company::select(['a.id', 'a.name', 'a.logo_path', DB::raw('count(b.id) as ttl_pengawas')])
                        ->from('m_company AS a')
                        ->leftJoin('sim_user_company AS b', 'a.id', '=', 'b.company_id')
                        ->where('a.comp_type', $request->comp_type)
                        ->groupByRaw('a.id,a.name,a.logo_path');
                $users = Auth::user();
                if ($users->role_id == '35') {
                    $data->where('a.created_by', $users->id);
                }
                return DataTables::of($data)
                                ->addIndexColumn()
                                ->filter(function ($instance) use ($request) {
                                    if (!empty($request->get('search'))) {
                                        $instance->where(function($w) use($request) {
                                            $search = $request->get('search');
                                            $w->orWhere('a.name', 'LIKE', "%" . Str::lower($search['value']) . "%");
                                        });
                                    }
                                })->addColumn('image', function ($artist) {
                                    $url = url($artist->logo_path);
                                    return '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" />';
                                })
                                ->addColumn('action', function($row) use ($users) {
                                    $btn = '<a href="' . url('company/' . $row->id . '/view') . '" data-toggle="tooltip" data-original-title="View" class="btn btn-success btn-sm"><i class="fas fa-eye"></i> View</a> ';
                                    $btn .= '<a href="' . url('company/' . $row->id . '/ubah') . '" data-toggle="tooltip" data-original-title="Edit" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a> ';
                                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="action-delete btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a> ';
                                    if ($users->role_id == 38 || $users->role_id == 1) {
                                        $btn .= '<a href="' . url('company/' . $row->id . '/pengawas') . '" data-toggle="tooltip" data-original-title="Pengawas" class="btn btn-info btn-sm"><i class="fas fa-users"></i> Pengawas</a> ';
                                    }
                                    return $btn;
                                })
                                ->rawColumns(['image', 'action'])
                                ->make(true);
            }
        }
    }

    public function edit($id) {
        $Users = Company::find($id);
        return response()->json($Users);
    }

    public function update(Request $request, Company $datapost) {
        $validator = \Validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:255'],
//                    'address' => ['required', 'string', 'max:255'],
//                    'id_provinsi' => ['required', 'numeric'],
//                    'id_kota' => ['required', 'numeric'],
//                    'email' => ['required', 'email'],
//                    'phone' => ['required', 'numeric'],
//                    'longitude' => ['required', 'string', 'max:255'],
//                    'latitude' => ['required', 'string', 'max:255'],
//                    'logo' => ['string', 'max:255'],
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
            'address' => $request->address,
            'id_provinsi' => $request->id_provinsi,
            'id_kota' => $request->id_kota,
            'email' => $request->email,
            'phone' => $request->phone,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ];
        if ($request->id) {
            $input['updated_at'] = date('Y-m-d H:i:s');
            $input['updated_by'] = $user->id;
            Company::where('id', $request->id)->update($input);
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
        Company::find($id)->delete();
        return response()->json(['success' => true]);
    }

    public function pegawai(Request $request) {
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

    public function submit(Request $request, Company $company) {
        $idUser = 0;
        if ($request->email) {
            $userData = User::where('email', $request->email)->first();
            if ($userData) {
                $idUser = $userData->id;
            }
        }
        $users = Auth::user();
        $validator = \Validator::make($request->all(), [
//                    'nib' => ['required', 'string', 'max:13', 'min:13', 'regex:/^[0-9]+$/', 'unique:m_company,nib,' . $request->id],
//                    'no_wlkp' => ['required', 'string', 'max:255', 'regex:/^[0-9]+$/'],
                    'name' => ['required', 'string', 'max:255'],
//                    'address' => ['required', 'string', 'max:1000'],
//                    'prov_code' => ['required', 'string', 'exists:m_provinsi,prov_code'],
//                    'city_code' => ['required', 'string', 'exists:m_kota,city_code'],
//                    'kec_code' => ['required', 'string', 'exists:m_kecamatan,kec_code'],
//                    'kel_code' => ['required', 'string', 'exists:m_kelurahan,kel_code'],
//                    'sektor_code' => ['required', 'string', 'exists:m_sektor,sektor_code'],
//                    'email' => ['required', 'email', 'unique:users,email,' . $idUser],
//                    'phone' => ['required', 'string', 'max:18', 'regex:/^[0-9]+$/'],
//                    'longitude' => ['required', 'string', 'max:255'],
//                    'latitude' => ['required', 'string', 'max:255'],
//                    'npp_bpjs' => ['required', 'string', 'max:13', 'min:13'],
//                    'no_npwp' => ['required', 'string', 'max:15', 'min:15', 'regex:/^[0-9]+$/'],
//                    'jenis_usaha' => ['required', 'numeric'],
//                    'bidang_usaha' => ['required', 'numeric'],
//                    'logo' => ['required', 'max:10000', 'min:8', 'mimes:jpg,jpeg,png'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->toArray()
                            ], 422);
        }

        $photo = $request->file('logo');
        $pdfname = '';
        $pdfpath = '';
        if ($request->hasFile('logo')) {
            $path = public_path('uploads');
            $_domain = 'logo';
            $pathDomain = $path . DIRECTORY_SEPARATOR . $_domain;
            if (!File::exists($pathDomain)) {
                File::makeDirectory($pathDomain, 0755, true, true);
            }
            $pathYear = $pathDomain . DIRECTORY_SEPARATOR . date('Y');
            if (!File::exists($pathYear)) {
                File::makeDirectory($pathYear, 0755, true, true);
            }
            $pathMonth = $pathYear . DIRECTORY_SEPARATOR . date('m');
            if (!File::exists($pathMonth)) {
                File::makeDirectory($pathMonth, 0755, true, true);
            }
            $pdfname = $photo->getClientOriginalName();
            $pdfpath = 'uploads' . DIRECTORY_SEPARATOR . $_domain . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . $pdfname;
            $photo->move($pathMonth, $pdfname);
        }

        if (!$request->slug) {
            $slug = Str::slug($request->name, '-');
        } else {
            $slug = Str::slug($request->name, '-');
        }

        $provinsi = \App\Models\Provinsi::select('id')->where('prov_code', $request->prov_code)->first();
        $kota = \App\Models\Kota::select('id')->where('city_code', $request->city_code)->first();

        $input = [
            'nib' => $request->nib,
            'no_wlkp' => $request->no_wlkp,
            'name' => $request->name,
            'address' => $request->address,
            'id_provinsi' => $provinsi->id,
            'id_kota' => $kota->id,
            'prov_code' => $request->prov_code,
            'city_code' => $request->city_code,
            'kec_code' => $request->kec_code,
            'kel_code' => $request->kel_code,
            'sektor_code' => $request->sektor_code,
            'registrasi_no' => $request->registrasi_no,
            'email' => $request->email,
            'phone' => $request->phone,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'npp_bpjs' => $request->npp_bpjs,
            'no_npwp' => $request->no_npwp,
            'jenis_usaha' => $request->jenis_usaha,
            'bidang_usaha' => $request->bidang_usaha,
            'status' => 1,
            'logo' => $pdfname,
            'logo_path' => $pdfpath,
            'comp_type' => 'company'
        ];
        if ($request->has('id')) {
            $input['updated_at'] = date('Y-m-d H:i:s');
            $input['updated_by'] = $users->id;
            Company::where('id', $request->id)
                    ->update($input);
            return response()->json([
                        'success' => true,
                        'message' => 'Update data perusahaan berhasil.',
            ]);
        } else {
            $input['created_at'] = date('Y-m-d H:i:s');
            $input['created_by'] = $users->id;
            $result = $company->storeData($input);
            if ($result) {
                return response()->json([
                            'success' => true,
                            'message' => 'Pendaftaran PJK3 Berhasil',
                ]);
            } else {
                return response()->json([
                            'success' => false,
                            'message' => 'Pendaftaran PJK3 Gagal',
                ]);
            }
        }
    }

    public function ubah($id) {
        $users = Auth::user();
        $user = $users->name;
        $provinsis = \App\Models\Provinsi::pluck('name', 'prov_code AS id');
        $kotas = \App\Models\Kota::pluck('name', 'city_code AS id');
        $jeniss = \App\Models\Jenisusaha::pluck('name', 'id');
        $bidangs = \App\Models\Bidangusaha::pluck('name', 'id');
        $sektors = \App\Models\Sektor::pluck('name', 'sektor_code AS id');
        $company = Company::select(['m_company.*'])->where('id', $id)->first();
        return view('company.update', [
            'provinsis' => $provinsis,
            'kotas' => $kotas,
            'jeniss' => $jeniss,
            'bidangs' => $bidangs,
            'sektors' => $sektors,
            'user' => $user,
            'company' => $company
        ]);
    }

    public function view($id) {
        $users = Auth::user();
        $user = $users->name;
        $provinsis = \App\Models\Provinsi::pluck('name', 'prov_code AS id');
        $kotas = \App\Models\Kota::pluck('name', 'city_code AS id');
        $jeniss = \App\Models\Jenisusaha::pluck('name', 'id');
        $bidangs = \App\Models\Bidangusaha::pluck('name', 'id');
        $sektors = \App\Models\Sektor::pluck('name', 'sektor_code AS id');
        $company = Company::select(['m_company.*'])->where('id', $id)->first();
        return view('company.view', [
            'provinsis' => $provinsis,
            'kotas' => $kotas,
            'jeniss' => $jeniss,
            'bidangs' => $bidangs,
            'sektors' => $sektors,
            'user' => $user,
            'company' => $company
        ]);
    }

    public function show($id) {
        $company = Company::select(['m_company.*'])->where('id', $id)->first();
        return response()->json($company);
    }

    public function export_excel(Request $request) {
        date_default_timezone_set("Asia/Bangkok");
        ini_set('memory_limit', '1024M');
        ini_set('upload_max_filesize', '1024M');
        ini_set('post_max_size', '1024M');
        $users = Auth::user();
        $filename = 'report_company_' . $users->id . '.xls';
        return Excel::download(new \App\Exports\CompanyExport($request), $filename);
    }

    public function anggota($id) {
        $biodata = Company::find($id);
        return View('company.anggota', [
            'biodata' => $biodata,
            'id' => $id
        ]);
    }

    public function fcomp($id, Request $request) {
        if ($request->ajax()) {
            $data = Company::select(['m_company.id', 'm_company.name', 'm_company.logo_path'])
                    ->leftJoin('users', 'users.id', '=', 'm_company.created_by')
                    ->where('m_company.comp_type', 'company')
                    ->where('users.company_id', $id);
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

}
