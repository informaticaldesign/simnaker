<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Pengaduan;
use Illuminate\Support\Str;
use File;

/**
 * Description of AksesController
 *
 * @author heryhandoko
 */
class PengaduanController
{
    //put your code here
    public function index()
    {
        $kotas = \App\Models\Kota::pluck('name', 'city_code AS id');
        $kategori = [
            'kecelakaan_kerja' => 'Kecelakaan Kerja',
            'tenaga_kerja_asing' => 'Tenaga Kerja Asing',
            'percaloan_tenaga_kerja' => 'Percaloan Tenaga Kerja',
            'bpjs_ketenagakerjaan' => 'BPJS Ketenagakerjaan',
            'pekerja_migran_indonesia' => 'Pekerja Migran Indonesia',
            'pungutan_liar' => 'Pungutan Liar',
        ];
        return view('frontend.pengaduan.index', [
            'kotas' => $kotas,
            'categories' => $kategori
        ]);
    }

    public function store(Request $request, Pengaduan $datapost)
    {
        $validator = \Validator::make($request->all(), [
            'jenis' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'kategori' => ['required'],
            'lokasi' => ['required'],
            'judul' => ['required'],
            'laporan' => ['required'],
            'phone' => ['required', 'string', 'max:18', 'regex:/^[0-9]+$/'],
            'lampiran' => ['required', 'max:2000', 'min:10', 'mimes:pdf,jpeg,jpg,png'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->toArray()
            ], 422);
        }

        $photo = $request->file('lampiran');
        $pdfname = '';
        $pdfpath = '';
        if ($request->hasFile('lampiran')) {
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

        if (!$request->slug) {
            $slug = Str::slug($request->name, '-');
        } else {
            $slug = Str::slug($request->name, '-');
        }

        $input = [
            'jenis' => $request->jenis,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'kategori' => $request->kategori,
            'lokasi' => $request->lokasi,
            'judul' => $request->judul,
            'laporan' => $request->laporan,
            'status' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'slug' => $slug,
            'lampiran' => $pdfname,
            'lampiran_path' => $pdfpath
        ];
        $result = $datapost->storeData($input);
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Pelaporan Berhasil',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Pelaporan Gagal',
            ]);
        }
    }
}
