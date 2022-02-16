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
use Illuminate\Support\Facades\Hash;
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
            'kotas' => $kotas
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
            DB::statement(DB::raw('set @rownum=0'));
            $data = Company::select(['*', DB::raw('@rownum  := @rownum  + 1 AS rownum')]);
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->filter(function ($instance) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $instance->where(function($w) use($request) {
                                        $search = $request->get('search');
                                        $w->orWhere('name', 'LIKE', "%" . Str::lower($search['value']) . "%");
                                    });
                                }
                            })->addColumn('image', function ($artist) {
                                $url = url($artist->logo_path);
                                return '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" />';
                            })
                            ->addColumn('action', function($row) {
                                $btn = '<a href="' . url('company/' . $row->id . '/view') . '" data-toggle="tooltip" data-original-title="View" class="btn btn-success btn-sm"><i class="fas fa-eye"></i> View</a> ';
                                $btn .= '<a href="' . url('company/' . $row->id . '/ubah') . '" data-toggle="tooltip" data-original-title="Edit" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a> ';
                                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="action-delete btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>';
                                return $btn;
                            })
                            ->rawColumns(['image', 'action'])
                            ->make(true);
        }
    }

    public function edit($id) {
        $Users = Company::find($id);
        return response()->json($Users);
    }

    public function update(Request $request, Company $datapost) {
        $validator = \Validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:255'],
                    'address' => ['required', 'string', 'max:255'],
                    'id_provinsi' => ['required', 'numeric'],
                    'id_kota' => ['required', 'numeric'],
                    'email' => ['required', 'email'],
                    'phone' => ['required', 'numeric'],
                    'longitude' => ['required', 'string', 'max:255'],
                    'latitude' => ['required', 'string', 'max:255'],
                    'logo' => ['string', 'max:255'],
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

    public function submit(Request $request, Company $company) {
        $idUser = 0;
        if ($request->email) {
            $userData = User::where('email', $request->email)->first();
            if ($userData) {
                $idUser = $userData->id;
            }
        }
        $validator = \Validator::make($request->all(), [
                    'nib' => ['required', 'string', 'max:255', 'unique:m_company,nib,' . $request->id],
                    'no_wlkp' => ['required', 'string', 'max:255'],
                    'name' => ['required', 'string', 'max:255'],
                    'address' => ['required', 'string', 'max:1000'],
                    'prov_code' => ['required', 'string', 'exists:m_provinsi,prov_code'],
                    'city_code' => ['required', 'string', 'exists:m_kota,city_code'],
                    'kec_code' => ['required', 'string', 'exists:m_kecamatan,kec_code'],
                    'kel_code' => ['required', 'string', 'exists:m_kelurahan,kel_code'],
                    'sektor_code' => ['required', 'string', 'exists:m_sektor,sektor_code'],
                    'email' => ['required', 'email', 'unique:users,email,' . $idUser],
                    'phone' => ['required', 'string', 'max:18', 'regex:/^[0-9]+$/'],
                    'longitude' => ['required', 'string', 'max:255'],
                    'latitude' => ['required', 'string', 'max:255'],
                    'npp_bpjs' => ['required', 'string', 'max:255'],
                    'no_npwp' => ['required', 'string', 'max:25', 'regex:/^[0-9]+$/'],
                    'pemeriksa' => ['required', 'string', 'max:255'],
                    'nik_ktp_p' => ['required', 'string', 'max:25', 'regex:/^[0-9]+$/'],
                    'penanggung_jwb' => ['required', 'string', 'max:255'],
                    'nik_ktp_t' => ['required', 'string', 'max:25', 'regex:/^[0-9]+$/'],
                    'jenis_usaha' => ['required', 'numeric'],
                    'bidang_usaha' => ['required', 'numeric'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                    'password_confirmation' => ['required', 'string', 'min:8', 'same:password'],
                    'logo' => ['required', 'max:10000', 'min:8', 'mimes:jpg,jpeg,png'],
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
            'pemeriksa' => $request->pemeriksa,
            'nik_ktp_p' => $request->nik_ktp_p,
            'penanggung_jwb' => $request->penanggung_jwb,
            'nik_ktp_t' => $request->nik_ktp_t,
            'jenis_usaha' => $request->jenis_usaha,
            'bidang_usaha' => $request->bidang_usaha,
            'status' => 1,
            'logo' => $pdfname,
            'logo_path' => $pdfpath
        ];
        if ($request->has('id')) {
            $input['updated_at'] = date('Y-m-d H:i:s');
            Company::where('id', $request->id)
                    ->update($input);
            $dataUser = User::select(['email'])->where('email', $request->email)->first();
            if ($dataUser) {
                $user = User::find($dataUser->id);  // Find the user using model and hold its reference
                $user->name = $request->name;
                $user->save();
            } else {
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role_id' => 35,
                    'company_id' => $request->id
                ]);
            }
            return response()->json([
                        'success' => true,
                        'message' => 'Update data perusahaan berhasil.',
            ]);
        } else {
            $input['created_at'] = date('Y-m-d H:i:s');
            $result = $company->storeData($input);
            if ($result) {
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role_id' => 35,
                    'company_id' => $result->id
                ]);
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

}
