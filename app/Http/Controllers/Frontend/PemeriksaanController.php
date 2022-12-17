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
use App\Models\User;
use Illuminate\Support\Str;
use File;
use Illuminate\Support\Facades\Hash;

/**
 * Description of AksesController
 *
 * @author heryhandoko
 */
class PemeriksaanController
{
    //put your code here
    public function index()
    {
        return view('frontend.pemeriksaan.index');
    }

    public function register(Request $request, Pengaduan $datapost)
    {
        $validator = \Validator::make($request->all(), [
            'nik' => ['required', 'string', 'max:18', 'regex:/^[0-9]+$/'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'phone' => ['required', 'string', 'max:18', 'regex:/^[0-9]+$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8', 'same:password'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->toArray()
            ], 422);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 40
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran Berhasil',
        ]);
    }

    public function masuk(Request $request, Pengaduan $datapost)
    {
        $validator = \Validator::make($request->all(), [
            'nik' => ['required', 'string', 'max:18', 'regex:/^[0-9]+$/'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'regex:/^[0-9]+$/'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->toArray()
            ], 422);
        }
    }

    public function login()
    {
        return view('frontend.pemeriksaan.login');
    }
}
