<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Biodata;
use App\Models\User;
use Auth;
use File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        $users = Auth::user();
        $user = $users->name;
        if ($users->role_id == '35') {
            $provinsis = \App\Models\Provinsi::pluck('name', 'id');
            $kotas = \App\Models\Kota::pluck('name', 'id');
            $jeniss = \App\Models\Jenisusaha::pluck('name', 'id');
            $bidangs = \App\Models\Bidangusaha::pluck('name', 'id');
            return view('pjk3.profile', [
                'provinsis' => $provinsis,
                'kotas' => $kotas,
                'jeniss' => $jeniss,
                'bidangs' => $bidangs,
                'user' => $user
            ]);
        } elseif ($users->role_id == '34') {
            $provinsis = \App\Models\Provinsi::pluck('name', 'id');
            $kotas = \App\Models\Kota::pluck('name', 'id');
            $jabatan = \App\Models\Jabatan::pluck('name', 'id');
            $pangkat = \App\Models\Pangkat::pluck('name', 'id');
            $golongan = \App\Models\Golongan::pluck('name', 'id');
            $unitkerja = \App\Models\Unitkerja::pluck('name', 'id');
            return view('profile.pengawas', [
                'provinsis' => $provinsis,
                'kotas' => $kotas,
                'user' => $user,
                'users' => $users,
                'jabatan' => $jabatan,
                'pangkat' => $pangkat,
                'golongan' => $golongan,
                'unitkerja' => $unitkerja
            ]);
        } elseif ($users->role_id == '37') {
            $provinsis = \App\Models\Provinsi::pluck('name', 'id');
            $kotas = \App\Models\Kota::pluck('name', 'id');
            $jabatan = \App\Models\Jabatan::pluck('name', 'id');
            $pangkat = \App\Models\Pangkat::pluck('name', 'id');
            $golongan = \App\Models\Golongan::pluck('name', 'id');
            $unitkerja = \App\Models\Unitkerja::pluck('name', 'id');
            return view('profile.admin', [
                'provinsis' => $provinsis,
                'kotas' => $kotas,
                'user' => $user,
                'users' => $users,
                'jabatan' => $jabatan,
                'pangkat' => $pangkat,
                'golongan' => $golongan,
                'unitkerja' => $unitkerja
            ]);
        } else {
            return view('profile', compact('user'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show() {
        //
        $model = new \App\Models\Company();
        $users = Auth::user();
        $Users = $model::find($users->company_id);
        return response()->json($Users);
    }

    public function personal() {
        //
        $users = Auth::user();
        $data = User::select([
                    'b.id',
                    'a.name',
                    'b.nip',
                    'b.birth_place',
                    'b.birth_date',
                    'b.id_jabatan',
                    'b.id_golongan',
                    'b.id_pangkat',
                    'b.id_uptd',
                    'b.address',
                    'b.id_kota',
                    'b.id_provinsi',
                    'b.latitude',
                    'b.longitude',
                    'a.email',
                    'b.phone',
                    'b.avatar_path',
                    'b.avatar'])
                ->from('users AS a')
                ->leftJoin('sim_biodata AS b', 'b.id', '=', 'a.biodata_id')
                ->where('a.id', $users->id)
                ->first();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $datapost) {
        //
        $fieldValidate = [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'id_provinsi' => ['required', 'numeric'],
            'id_kota' => ['required', 'numeric'],
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
        ];
        $user = auth()->user();
        if ($request->password) {
            $fieldValidate['password'] = ['required', function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        $fail('Your password was not updated, since the provided current password does not match.');
                    }
                }];
            $fieldValidate['password_new'] = ['required', 'string', 'min:8', 'different:password'];
            $fieldValidate['password_confirmation'] = ['required', 'string', 'min:8', 'same:password_new'];
        }
        $validator = \Validator::make($request->all(), $fieldValidate);
        if ($validator->fails()) {
            return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->toArray()
                            ], 422);
        } else {
            if ($request->password && $request->password_new) {
                $user->fill([
                    'password' => Hash::make($request->password_new)
                ])->save();
            }
        }

        $photo = $request->file('logo');
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
            $input['logo'] = $pdfname;
            $input['logo_path'] = $pdfpath;
        }

        if (!$request->slug) {
            $slug = Str::slug($request->name, '-');
        } else {
            $slug = Str::slug($request->name, '-');
        }

        $users = Auth::user();
        $input = [
            'name' => $request->name,
            'slug' => $slug,
            'address' => $request->address,
            'id_provinsi' => $request->id_provinsi,
            'id_kota' => $request->id_kota,
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
            'status' => 1
        ];
        $input['updated_at'] = date('Y-m-d H:i:s');
        $input['updated_by'] = $users->id;
        Company::where('id', $users->company_id)->update($input);
        $user->fill([
            'name' => $request->name,
            'updated_at' => date('Y-m-d H:i:s'),
        ])->save();
        return response()->json([
                    'success' => true,
                    'message' => 'Update Profile Berhasil',
        ]);
    }

    public function simpan(Request $request, Biodata $biodata) {
        $user = auth()->user();
        $users = Auth::user();
        $fieldValidate = [
            'name' => ['required', 'string', 'max:255'],
            'birth_place' => ['required', 'string', 'max:100'],
            'birth_date' => ['required', 'date_format:Y-m-d'],
            'id_jabatan' => ['required', 'numeric'],
            'id_golongan' => ['required', 'numeric'],
            'id_pangkat' => ['required', 'numeric'],
            'id_uptd' => ['required', 'numeric'],
            'address' => ['required', 'string', 'max:1000'],
            'id_kota' => ['required', 'numeric'],
            'id_provinsi' => ['required', 'numeric'],
            'longitude' => ['required', 'string', 'max:255'],
            'latitude' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:18', 'regex:/^[0-9]+$/'],
            'avatar' => ['required', 'max:10000', 'min:1', 'mimes:jpg,jpeg,png'],
        ];

        $input = [
            'name' => $request->name,
            'birth_place' => $request->birth_place,
            'birth_date' => $request->birth_date,
            'id_jabatan' => $request->id_jabatan,
            'id_golongan' => $request->id_golongan,
            'id_pangkat' => $request->id_pangkat,
            'id_uptd' => $request->id_uptd,
            'address' => $request->address,
            'id_kota' => $request->id_kota,
            'id_provinsi' => $request->id_provinsi,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'email' => $request->email,
            'phone' => $request->phone,
            'avatar' => $request->avatar,
            'email' => $users->email,
            'status' => 'completed'
        ];

        if (!$request->id) {
            $fieldValidate['nip'] = ['required', 'string', 'max:25', 'unique:sim_biodata'];
            $input['nip'] = $request->nip;
        }

        if ($request->password) {
            $fieldValidate['password'] = ['required', function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        $fail('Your password was not updated, since the provided current password does not match.');
                    }
                }];
            $fieldValidate['password_new'] = ['required', 'string', 'min:8', 'different:password'];
            $fieldValidate['password_confirmation'] = ['required', 'string', 'min:8', 'same:password_new'];
        }
        $validator = \Validator::make($request->all(), $fieldValidate);
        if ($validator->fails()) {
            return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->toArray()
                            ], 422);
        } else {
            if ($request->password && $request->password_new) {
                $user->fill([
                    'password' => Hash::make($request->password_new)
                ])->save();
            }
        }
        $photo = $request->file('avatar');
        if ($request->hasFile('avatar')) {
            $path = public_path('uploads');
            $_domain = 'profile';
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
//            $extension = $photo->extension();
            $pdfpath = 'uploads' . DIRECTORY_SEPARATOR . $_domain . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . $pdfname;
            $photo->move($pathMonth, $pdfname);
            $input['avatar'] = $pdfname;
            $input['avatar_path'] = $pdfpath;
        }
        if ($request->id) {
            $input['updated_at'] = date('Y-m-d H:i:s');
            $input['updated_by'] = $users->id;
            $data = Biodata::where('id', $users->biodata_id)->update($input);
            $biodataId = $request->id;
        } else {
            $input['created_at'] = date('Y-m-d H:i:s');
            $input['created_by'] = $users->id;
            $data = $biodata->storeData($input);
            $biodataId = $data->id;
        }
        $user->fill([
            'name' => $request->name,
            'biodata_id' => $biodataId,
            'updated_at' => date('Y-m-d H:i:s'),
        ])->save();
        return response()->json([
                    'success' => true,
                    'message' => 'Update Profile Berhasil',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
