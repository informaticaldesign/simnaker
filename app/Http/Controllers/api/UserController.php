<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Biodata;
use DB;

class UserController extends Controller {

    public $successStatus = 200;

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
                    'nik' => 'required|numeric',
                    'password' => 'required',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->toArray();
            $field = '';
            $msgError = '';
            foreach ($error as $key => $val) {
                $field = $key;
                $msgError = $val[0];
                break;
            }
            $respon = [
                'status' => 'error',
                'message' => 'Login error',
                'errors' => [
                    'field' => $field,
                    'msg' => $msgError
                ],
                'data' => null,
            ];
            return response()->json($respon, 401);
        }

        if (Auth::attempt(['nik' => request('nik'), 'password' => request('password')])) {
            $user = Auth::user();
            $tokenResult = $user->createToken('nApp')->accessToken;
            $respon = [
                'status' => 'success',
                'message' => 'Login successfully',
                'errors' => null,
                'status_code' => 200,
                'content' => [
                    'token_type' => 'Bearer',
                    'name' => $user->name,
                    'email' => $user->email,
                    'nik' => $user->nik,
                    'access_token' => $tokenResult,
                    'status_ktp' => $user->status_ktp,
                    'user_id' => $user->id
                ]
            ];
            return response()->json($respon, $this->successStatus);
        } else {
            $respon = [
                'status' => 'error',
                'message' => 'Login gagal',
                'errors' => [
                    'field' => 'password',
                    'msg' => 'Username dan password no match'
                ],
                'data' => null,
            ];
            return response()->json($respon, 401);
        }
    }

    public function register(Request $request, Biodata $biodata) {
        $validator = Validator::make($request->all(), [
                    'nik' => 'required|string|min:16|max:16|unique:users',
                    'name' => 'required',
                    'kec_id' => 'required',
                    'phone' => 'required|numeric|unique:biodata',
                    'email' => 'required|email|unique:users',
                    'password' => 'required',
                    'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->toArray();
            $field = '';
            $msgError = '';
            foreach ($error as $key => $val) {
                $field = $key;
                $msgError = $val[0];
                break;
            }
            $respon = [
                'status' => 'error',
                'message' => 'Register error',
                'errors' => [
                    'field' => $field,
                    'msg' => $msgError
                ],
                'data' => null,
            ];
            return response()->json($respon, 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        if ($user) {
            $bio = [
                'name' => $input['name'],
                'nik' => $input['nik'],
                'email' => $input['email'],
                'address' => $input['address'],
                'phone' => $input['phone'],
                'created_at' => date('Y-m-d H:i:s'),
                'kec_id' => $input['kec_id'],
                'created_by' => $user->name,
                'user_id' => $user->id,
            ];
            $bioId = $biodata->storeData($bio);
            $data['token'] = $user->createToken('nApp')->accessToken;
            $data['name'] = $user->name;
            $data['user_id'] = $user->id;
            $data['biodata_id'] = $bioId->id;
            $respon = [
                'status' => 'success',
                'message' => 'Register successfully',
                'errors' => null,
                'content' => $data,
            ];
            return response()->json($respon, $this->successStatus);
        } else {
            $respon = [
                'status' => 'error',
                'message' => 'Register error',
                'errors' => [
                    'field' => $field,
                    'msg' => $msgError
                ],
                'data' => null,
            ];
            return response()->json($respon, 401);
        }
    }

    public function details() {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function logout(Request $request) {
        $logout = $request->user()->token()->revoke();
        if ($logout) {
            $respon = [
                'status' => 'success',
                'message' => 'Successfully logged out',
                'errors' => null,
                'data' => null
            ];
            return response()->json($respon, $this->successStatus);
        }
    }

    public function unggah(Request $request) {
        date_default_timezone_set("Asia/Bangkok");
        ini_set('memory_limit', '1024M');
        ini_set('upload_max_filesize', '1024M');
        ini_set('post_max_size', '1024M');
        $image = $request->image;
        $name = $request->name;
        $userId = $request->user_id;

        $dirEktp = public_path('ektp');
        $_year = date('Y');
        $_month = date('m');
        if ($image !== '') {
            $realImage = base64_decode($image);
            if (!file_exists($dirEktp . DIRECTORY_SEPARATOR . $_year)) {
                mkdir($dirEktp . DIRECTORY_SEPARATOR . $_year, 0777, true);
            }
            if (!file_exists($dirEktp . DIRECTORY_SEPARATOR . $_year . DIRECTORY_SEPARATOR . $_month)) {
                mkdir($dirEktp . DIRECTORY_SEPARATOR . $_year . DIRECTORY_SEPARATOR . $_month, 0777, true);
            }
            file_put_contents($dirEktp . DIRECTORY_SEPARATOR . $_year . DIRECTORY_SEPARATOR . $_month . DIRECTORY_SEPARATOR . $userId . '_' . $name, $realImage);
            User::where('id', $userId)->update([
                'status_ktp' => 1
            ]);
            Biodata::where('user_id', $userId)->update([
                'ektp' => $_year . DIRECTORY_SEPARATOR . $_month . DIRECTORY_SEPARATOR . $userId . '_' . $name
            ]);
        }
        $respon = [
            'status' => 'success',
            'message' => 'Upload success',
            'errors' => null,
            'data' => null
        ];
        return response()->json($respon, $this->successStatus);
    }

    public function resetpass(Request $request) {
        $validator = Validator::make($request->all(), [
                    'email' => 'required|email',
                    'password' => 'required',
                    'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->toArray();
            $field = '';
            $msgError = '';
            foreach ($error as $key => $val) {
                $field = $key;
                $msgError = $val[0];
                break;
            }
            $respon = [
                'status' => 'error',
                'message' => 'Register error',
                'errors' => [
                    'field' => $field,
                    'msg' => $msgError
                ],
                'data' => null,
            ];
            return response()->json($respon, 401);
        }

        $cekUser = User::where('email', $request->email)->first();
        if (!$cekUser) {
            $respon = [
                'status' => 'error',
                'message' => 'Register error',
                'errors' => [
                    'field' => 'email',
                    'msg' => 'Email tidak terdaftar'
                ],
                'data' => null,
            ];
            return response()->json($respon, 401);
        } else {
            User::where('email', $request->email)->update([
                'password' => bcrypt($request->password)
            ]);
            $respon = [
                'status' => 'success',
                'message' => 'Reset success',
                'errors' => null,
                'data' => null
            ];
            return response()->json($respon, $this->successStatus);
        }
    }

    public function antrian() {
        $antrian = DB::table('calenders')
                ->select(DB::raw('id,tanggal,DATE_FORMAT(tanggal, "%d %b %Y") AS tanggal_txt,hari,CASE WHEN `tanggal`=CURDATE() THEN "Tutup" ELSE `status` END AS `status`,tersedia,terisi'))
                ->where('tanggal', '>=', date('Y-m-d'))
                ->limit(10)
                ->orderBy('tanggal', 'asc')
                ->get();
        $respon = [
            'status' => 'success',
            'message' => 'Get Antrian successfully',
            'errors' => null,
            'status_code' => 200,
            'content' => $antrian
        ];
        return response()->json($respon, $this->successStatus);
    }

}
