<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Frontend;

use App\Models\Biodata;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

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
        if (Auth::check()) {
            return redirect()->intended('admin');
        } else {
            return view('frontend.pemeriksaan.index');
        }
    }

    public function register(Request $request, Pengaduan $datapost)
    {
        $validator = \Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'phone' => ['required', 'string', 'max:18', 'regex:/^[0-9]+$/'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'min:8', 'same:password'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->toArray()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'password_confirm' => $request->password,
            'role_id' => 41
        ]);
        if ($user) {
            $bioinput = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $user->id,
                'user_id' => $user->id,
            ];
            $bio = Biodata::create($bioinput);
            User::where('id', $user->id)->update(['biodata_id' => $bio->id]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran Berhasil',
        ]);
    }

    public function masuk(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            return response()->json([
                'success' => true,
                'message' => 'Login success'
            ], 200);
        } else {
            return response()->json([
                'errors' => [
                    'email' => ['Username dan Password Salah']
                ]
            ], 422);
        }
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect()->intended('admin');
        } else {
            return view('frontend.pemeriksaan.login');
        }
    }
}
