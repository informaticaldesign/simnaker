<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Company;
use Illuminate\Support\Str;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use DB;

class PjkkkController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function proses() {
        return View('pjkkk.index', [
            'slug' => 'proses',
            'title' => 'Proses',
        ]);
    }

    public function verify() {
        return View('pjkkk.index', [
            'slug' => 'verify',
            'title' => 'Terverifikasi',
        ]);
    }

    public function fetch(Request $request) {
        if ($request->ajax()) {
            $status = 0;
            if ($request->slug == 'verify') {
                $status = 1;
            }
            $data = Company::select(['id', 'name', 'created_at', 'status'])
                    ->where('status', $status)
                    ->where('comp_type', 'agent');
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
                            ->editColumn('created_at', function ($request) {
                                return $request->created_at->format('d M Y');
                            })
                            ->addColumn('status', function($row) {
                                if ($row->status == 0) {
                                    $btn = '<small class="badge badge-warning">Proses</small>';
                                } else {
                                    $btn = '<small class="badge badge-success">Terverifikasi</small>';
                                }
                                return $btn;
                            })
                            ->addColumn('action', function($row) {
                                $btn = '<a href="' . url('admin/pjkkk/' . $row->id . '/view') . '" data-toggle="tooltip" data-original-title="View" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a> ';
                                if ($row->status == 0) {
                                    $btn .= '<a href="' . url('admin/pjkkk/' . $row->id . '/ubah') . '" data-toggle="tooltip" data-original-title="Edit" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a> ';
                                }
                                return $btn;
                            })
                            ->rawColumns(['status', 'action'])
                            ->make(true);
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
        return view('pjkkk.update', [
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
        return view('pjkkk.view', [
            'provinsis' => $provinsis,
            'kotas' => $kotas,
            'jeniss' => $jeniss,
            'bidangs' => $bidangs,
            'sektors' => $sektors,
            'user' => $user,
            'company' => $company
        ]);
    }

    public function submit(Request $request, Company $company) {
        $idUser = 0;
        if ($request->email) {
            $userData = User::where('email', $request->email)->first();
            if ($userData) {
                $idUser = $userData->id;
                User::find($idUser)->delete();
            }
        }
        $validator = \Validator::make($request->all(), [
                    'id' => ['required', 'numeric'],
                    'status' => ['required', 'numeric'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->toArray()
                            ], 422);
        }

        $input = [
            'status' => $request->status,
        ];
        if ($request->has('id')) {
            $input['updated_at'] = date('Y-m-d H:i:s');
            $company->where('id', $request->id)
                    ->update($input);

            if ($request->status == 1) {
                $user = DB::table('users_temp')->where('email', $request->email)->first();
                User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'password' => $user->password,
                    'password_confirm' => $user->password_confirm,
                    'role_id' => 35,
                    'company_id' => $request->id
                ]);

//                $password = 'Init1234!';
//                $dataUser = User::create([
//                            'name' => $request->name,
//                            'email' => $request->email,
//                            'password' => Hash::make($password),
//                            'password_confirm' => $password,
//                            'role_id' => 35,
//                            'company_id' => $request->id
//                ]);
//                if ($dataUser) {
//                    $data = [
//                        'name' => $dataUser->name,
//                        'username' => $dataUser->email,
//                        'password' => $password
//                    ];
//                    Mail::send('pjkkk.approve', $data, function($message) use($dataUser) {
//                        $message->to($dataUser->email, $dataUser->name)
//                                ->bcc('heri.handoko@mncgroup.com', 'Hery Handoko')
//                                ->from("noreplay@simanker.go.id", "Simanker Banten Prov")
//                                ->subject('Notifikasi Registrasi Online Simnaker Banten Prov');
//                    });
//                }
            } else {
//                $data = [
//                    'name' => $request->name
//                ];
//                Mail::send('pjkkk.reject', $data, function($message) use ($request) {
//                    $message->to($request->email, $request->name)
//                            ->bcc('heri.handoko@mncgroup.com', 'Hery Handoko')
//                            ->from("noreplay@simanker.go.id", "Simanker Banten Prov")
//                            ->subject('Notifikasi Registrasi Online Simnaker Banten Prov');
//                });
            }
            return response()->json([
                        'success' => true,
                        'message' => 'Update data perusahaan berhasil.',
            ]);
        }
    }

}
