<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use File;

class RegistrasiController {

    //put your code here
    public function index(Request $request) {
        $provinsis = \App\Models\Provinsi::pluck('name', 'prov_code AS id');
        $kotas = \App\Models\Kota::pluck('name', 'city_code AS id');
        $jeniss = \App\Models\Jenisusaha::pluck('name', 'id');
        $bidangs = \App\Models\Bidangusaha::pluck('name', 'id');
        return view('frontend.registrasi.index', [
            'provinsis' => $provinsis,
            'kotas' => $kotas,
            'jeniss' => $jeniss,
            'bidangs' => $bidangs
        ]);
    }

    public function submit(Request $request, Company $datapost) {
        $validator = \Validator::make($request->all(), [
                    'nib' => ['required', 'string', 'max:13', 'min:13', 'unique:m_company', 'regex:/^[0-9]+$/'],
                    'no_wlkp' => ['required', 'string', 'max:255', 'regex:/^[0-9]+$/'],
                    'name' => ['required', 'string', 'max:255'],
                    'address' => ['required', 'string', 'max:255'],
                    'prov_code' => ['required', 'string', 'exists:m_provinsi,prov_code'],
                    'city_code' => ['required', 'string', 'exists:m_kota,city_code'],
                    'email' => ['required', 'email', 'unique:users'],
                    'phone' => ['required', 'string', 'max:18', 'regex:/^[0-9]+$/'],
                    'longitude' => ['required', 'string', 'max:255'],
                    'latitude' => ['required', 'string', 'max:255'],
                    'npp_bpjs' => ['required', 'string', 'max:13', 'min:13'],
                    'no_npwp' => ['required', 'string', 'max:15', 'min:15', 'regex:/^[0-9]+$/'],
                    'pemeriksa' => ['required', 'string', 'max:255'],
                    'nik_ktp_p' => ['required', 'string', 'max:16', 'min:16', 'regex:/^[0-9]+$/'],
                    'penanggung_jwb' => ['required', 'string', 'max:255'],
                    'nik_ktp_t' => ['required', 'string', 'max:16', 'min:16', 'regex:/^[0-9]+$/'],
                    'jenis_usaha' => ['required', 'numeric'],
                    'bidang_usaha' => ['required', 'numeric'],
                    'filenpwp' => ['required', 'max:2000', 'min:10', 'mimes:pdf'],
                    'fileakta' => ['required', 'max:2000', 'min:10', 'mimes:pdf'],
//                    'password' => ['required', 'string', 'min:8', 'confirmed'],
//                    'password_confirmation' => ['required', 'string', 'min:8', 'same:password'],
//                    'logo' => ['required', 'max:10000', 'min:8', 'mimes:jpg,jpeg,png'],
//                    'captcha' => ['required', 'captcha'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->toArray()
                            ], 422);
        }

        $photo = $request->file('filenpwp');
        $pdfname = '';
        $pdfpath = '';
        if ($request->hasFile('filenpwp')) {
            $path = public_path('uploads');
            $_domain = 'npwp';
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

        $photox = $request->file('fileakta');
        $pdfnamex = '';
        $pdfpathx = '';
        if ($request->hasFile('fileakta')) {
            $pathx = public_path('uploads');
            $_domainx = 'akta';
            $pathDomainx = $pathx . DIRECTORY_SEPARATOR . $_domainx;
            if (!File::exists($pathDomainx)) {
                File::makeDirectory($pathDomain, 0755, true, true);
            }
            $pathYearx = $pathDomainx . DIRECTORY_SEPARATOR . date('Y');
            if (!File::exists($pathYearx)) {
                File::makeDirectory($pathYearx, 0755, true, true);
            }
            $pathMonthx = $pathYearx . DIRECTORY_SEPARATOR . date('m');
            if (!File::exists($pathMonthx)) {
                File::makeDirectory($pathMonthx, 0755, true, true);
            }
            $pdfnamex = $photo->getClientOriginalName();
            $pdfpathx = 'uploads' . DIRECTORY_SEPARATOR . $_domainx . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . $pdfnamex;
            $photox->move($pathMonthx, $pdfnamex);
        }

        if (!$request->slug) {
            $slug = Str::slug($request->name, '-');
        } else {
            $slug = Str::slug($request->name, '-');
        }

        $input = [
            'nib' => $request->nib,
            'no_wlkp' => $request->no_wlkp,
            'name' => $request->name,
            'address' => $request->address,
            'prov_code' => $request->prov_code,
            'city_code' => $request->city_code,
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
            'status' => 0,
            'logo' => 'building-logo.jpeg',
            'logo_path' => 'uploads/logo/building-logo.jpeg',
            'created_at' => date('Y-m-d H:i:s'),
            'comp_type' => 'agent',
            'slug' => $slug
        ];
        $result = $datapost->storeData($input);
        if ($result) {
//            User::create([
//                'name' => $request->name,
//                'email' => $request->email,
//                'password' => Hash::make($request->password),
//                'role_id' => 35,
//                'company_id' => $result->id
//            ]);
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
