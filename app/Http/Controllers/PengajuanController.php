<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use App\Models\Spt;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Suket;
use DataTables;
use Auth;
use File;
use DB;
use App\Models\Usrcompsuket;
use App\Models\User;

/**
 * Description of PengajuanController
 *
 * @author heryhandoko
 */
class PengajuanController {

    //put your code here
    public function index() {
        $users = Auth::user();
        return View('pjk3.pengajuan.index', [
            'users' => $users
        ]);
    }

    public function create($step, $id) {
        $data = [];
        if ($id != '0') {
            $data = Suket::select(['*'])->where('id', Crypt::decrypt($id))->first();
        }
        $users = Auth::user();
        if ($step == 1) {
            return View('pjk3.pengajuan.create', [
                'step' => $step,
                'id' => $id,
                'data' => $data
            ]);
        } elseif ($step == 2) {
            return View('pjk3.pengajuan.createx', [
                'step' => $step,
                'id' => $id,
                'data' => $data
            ]);
        } elseif ($step == 3) {
            if ($users->role_id == 35) {
                $companies = \App\Models\Company::where('status', 1)
                        ->where('comp_type', 'company')
                        ->where('created_by', $users->id)
                        ->pluck('name', 'id');
            } elseif ($users->role_id == 34) {
                $companies = \App\Models\Company::where('status', 1)
                        ->where('comp_type', 'company')
                        ->where('id', $data->company_id)
                        ->pluck('name', 'id');
            } elseif ($users->role_id == 38) {
                $companies = \App\Models\Company::where('status', 1)
                        ->where('comp_type', 'company')
//                        ->where('id', $data->company_id)
                        ->pluck('name', 'id');
            }
            return View('pjk3.pengajuan.createxx', [
                'step' => $step,
                'id' => $id,
                'data' => $data,
                'companies' => $companies
            ]);
        } elseif ($step == 4) {
            $preview = true;
            if ($users->role_id == 35) {
                $preview = false;
            }
            return View('pjk3.pengajuan.createxxx', [
                'step' => $step,
                'id' => $id,
                'data' => $data,
                'users' => $users,
                'preview' => $preview
            ]);
        } elseif ($step == 5) {
            $pemeriksaan = \App\Models\Jenispem::pluck('name', 'id');
            $types = \App\Models\Typepem::pluck('name', 'id');
            $preview = true;
            if ($users->role_id == 35) {
                $preview = false;
            }
            return View('pjk3.pengajuan.createxxxx', [
                'step' => $step,
                'id' => $id,
                'data' => $data,
                'pemeriksaan' => $pemeriksaan,
                'types' => $types,
                'users' => $users,
                'preview' => $preview
            ]);
        } elseif ($step == 6) {
            if ($data->status == 'terkirim') {
                $biodata = \App\Models\Biodata::select([
                            'sim_biodata.*',
                            'm_jabatan.name AS jabatan_name',
                            'm_pangkat.name AS pangkat_name',
                            'm_golongan.name AS golongan_name'
                        ])
                        ->leftJoin('m_jabatan', 'm_jabatan.jabatan_code', '=', 'sim_biodata.jabatan_code')
                        ->leftJoin('m_pangkat', 'm_pangkat.pangkat_code', '=', 'sim_biodata.pangkat_code')
                        ->leftJoin('m_golongan', 'm_golongan.golongan_code', '=', 'sim_biodata.golongan_code')
                        ->join('users', 'users.biodata_id', '=', 'sim_biodata.id')
                        ->where('users.role_id', 39) // 39 role kepala UPT
                        ->get();
            } elseif ($data->status == 'proses') {
                $biodata = \App\Models\Biodata::select([
                            'sim_biodata.*',
                            'm_jabatan.name AS jabatan_name',
                            'm_pangkat.name AS pangkat_name',
                            'm_golongan.name AS golongan_name'
                        ])
                        ->leftJoin('m_jabatan', 'm_jabatan.jabatan_code', '=', 'sim_biodata.jabatan_code')
                        ->leftJoin('m_pangkat', 'm_pangkat.pangkat_code', '=', 'sim_biodata.pangkat_code')
                        ->leftJoin('m_golongan', 'm_golongan.golongan_code', '=', 'sim_biodata.golongan_code')
                        ->join('sim_bio_comp_suket', function($join) use ($data) {
                            $join->on('sim_bio_comp_suket.biodata_id', '=', 'sim_biodata.id');
                            $join->on('sim_bio_comp_suket.suket_id', '=', DB::raw($data->id));
                        })
                        ->get();
            }
            $upt = User::select(['a.id',
                        'a.name',
                        'a.biodata_id',
                        'c.name AS upt_name'])
                    ->from('users AS a')
                    ->join('sim_user_upt AS b', 'b.biodata_id', '=', 'a.biodata_id')
                    ->join('m_upt AS c', 'c.id', '=', 'b.upt_id')
                    ->where('role_id', 39)
                    ->get();
            return View('pjk3.pengajuan.createxxxxx', [
                'step' => $step,
                'id' => $id,
                'data' => $data,
                'users' => $users,
                'biodata' => $biodata,
                'upt' => $upt
            ]);
        }
    }

    public function store(Request $request, Suket $suket) {
        $next = $request->step;
        $users = Auth::user();
        if ($next == 1) {
            return response()->json([
                        'success' => true,
                        'data' => [
                            'next' => $next + 1,
                            'id' => 0
            ]]);
        } elseif ($next == 2) {
            if ($request->id != '0') {
                return response()->json([
                            'success' => true,
                            'data' => [
                                'next' => $next + 1,
                                'id' => $request->id
                ]]);
            } else {
                $fieldValidate = [
                    'no_surat' => ['required', 'string', 'max:32', 'unique:sim_suket'],
                ];
                $validator = \Validator::make($request->all(), $fieldValidate);
                if ($validator->fails()) {
                    return response()->json([
                                'success' => false,
                                'message' => $validator->errors()->toArray()
                                    ], 422);
                }

                $input = [
                    'no_surat' => $request->no_surat,
                    'created_by' => $users->id,
                    'status' => 'draft',
                    'step' => $next
                ];
                $result = $suket->storeData($input);
                if ($result) {
                    $idx = Crypt::encrypt($result->id);
                    return response()->json([
                                'success' => true,
                                'data' => [
                                    'next' => $next + 1,
                                    'id' => $idx
                    ]]);
                }
            }
        } elseif ($next == 3) {
            $fieldValidate = [
                'company_id' => ['required', 'exists:m_company,id'],
                'tgl_surat' => ['required', 'date_format:Y-m-d'],
            ];
            $validator = \Validator::make($request->all(), $fieldValidate);
            if ($validator->fails()) {
                return response()->json([
                            'success' => false,
                            'message' => $validator->errors()->toArray()
                                ], 422);
            }
            $idu = Crypt::decrypt($request->id);
            $result = Suket::where('id', $idu)->update([
                'company_id' => $request->company_id,
                'tgl_surat' => $request->tgl_surat,
                'step' => $next
            ]);
            if ($result) {
                return response()->json([
                            'success' => true,
                            'data' => [
                                'next' => $next + 1,
                                'id' => $request->id
                ]]);
            }
        } elseif ($next == 4) {
            if ($users->role_id == 35) {
                if ($request->menu == 'pengajuan') {
                    $fieldValidate = [
                        'lampiran' => ['required', 'max:10000', 'min:8', 'mimes:pdf'],
                    ];
                    $validator = \Validator::make($request->all(), $fieldValidate);
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
                        $_domain = 'lampiran';
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
                    $idu = Crypt::decrypt($request->id);
                    $result = Suket::where('id', $idu)->update([
                        'lampiran' => $pdfname,
                        'lampiran_path' => $pdfpath,
                        'step' => $next
                    ]);
                } else {
                    $result = true;
                }
            } else {
                $result = true;
            }
            if ($result) {
                return response()->json([
                            'success' => true,
                            'data' => [
                                'next' => $next + 1,
                                'id' => $request->id
                ]]);
            }
        } elseif ($next == 5) {
            if ($users->role_id == 35) {
                if ($request->menu == 'pengajuan') {
                    $fieldValidate = [
                        'attach_object' => ['required', 'max:10000', 'min:8', 'mimes:pdf'],
                        'id_pemeriksaan' => ['required', 'numeric'],
                        'jml_obyek' => ['required', 'numeric'],
                        'id_type_pem' => ['required', 'numeric'],
                    ];
                    $validator = \Validator::make($request->all(), $fieldValidate);
                    if ($validator->fails()) {
                        return response()->json([
                                    'success' => false,
                                    'message' => $validator->errors()->toArray()
                                        ], 422);
                    }
                    $photo = $request->file('attach_object');
                    $pdfname = '';
                    $pdfpath = '';
                    if ($request->hasFile('attach_object')) {
                        $path = public_path('uploads');
                        $_domain = 'obyekkkk';
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
                    $idu = Crypt::decrypt($request->id);
                    $result = Suket::where('id', $idu)->update([
                        'id_pemeriksaan' => $request->id_pemeriksaan,
                        'jml_obyek' => $request->jml_obyek,
                        'attach_object' => $pdfname,
                        'attach_object_path' => $pdfpath,
                        'id_type_pem' => $request->id_type_pem,
                        'status' => 'terkirim',
                        'step' => $next
                    ]);
                } else {
                    $result = true;
                }
                if ($result) {
                    return response()->json([
                                'success' => true,
                                'data' => [
                                    'next' => 0,
                                    'id' => 0
                    ]]);
                }
            } else {
                return response()->json([
                            'success' => true,
                            'data' => [
                                'next' => $next + 1,
                                'id' => $request->id
                ]]);
            }
        } elseif ($next == 6) {

            if ($request->menu == 'pengajuan') {
                $fieldValidate = [
                    'status' => ['required', 'string']
                ];
                $dataUpdate['status'] = $request->status;
                if ($request->status == 'proses') {
                    $fieldValidate['biodata_upt_id'] = ['required'];
                    $dataUpdate['biodata_upt_id'] = $request->biodata_upt_id;
                } elseif ($request->status == 'reject') {
                    $fieldValidate['reason'] = ['required', 'string', 'max:1000'];
                    $dataUpdate['reason'] = $request->reason;
                }
            } elseif ($request->menu == 'proses') {
                $fieldValidate = [
                    'status' => ['required', 'string'],
                    'pegawai' => ['required'],
                ];
                $dataUpdate = [
                    'status' => $request->status
                ];
            }
            $validator = \Validator::make($request->all(), $fieldValidate);
            if ($validator->fails()) {
                return response()->json([
                            'success' => false,
                            'message' => $validator->errors()->toArray()
                                ], 422);
            }
            $idu = Crypt::decrypt($request->id);
            $dataUpdate['updated_at'] = date('Y-m-d H:i:s');
            $dataUpdate['updated_by'] = $users->id;
            $result = Suket::where('id', $idu)->update($dataUpdate);
            if ($result) {
                if ($request->menu == 'proses') {
                    $pegawai = $request->pegawai;
                    $data = Suket::select(['company_id', 'id', 'no_surat', 'tgl_surat'])->where('id', $idu)->first();
                    if ($pegawai) {
                        Usrcompsuket::where('suket_id', $idu)->delete();
                        foreach ($pegawai as $val) {
                            Usrcompsuket::create([
                                'biodata_id' => $val,
                                'suket_id' => $idu,
                                'company_id' => $data->company_id,
                                'created_by' => $users->id,
                                'created_at' => date('Y-m-d H:i:s')
                            ]);
                        }
                        DB::table('sim_spt')->where('suket_id', '=', $idu)->delete();
                        $this->generateSpt($data, $pegawai);
                    }
                }
                return response()->json([
                            'success' => true,
                            'data' => [
                                'next' => 0,
                                'id' => 0
                ]]);
            } else {
                return response()->json([
                            'success' => false,
                            'data' => [
                                'next' => $next,
                                'id' => $request->id
                ]]);
            }
        }
    }

    function generateSpt($data, $pegawai) {
        $spt = new Spt();
        $users = Auth::user();

        $company = \App\Models\Company::select(['name', 'address'])->where('id', $data->company_id)->first();

        $uraian = 'Menindaklanjuti Surat Nomor: ' . $data->no_surat . ', tanggal ' . $data->tgl_surat . ' perihal Permohonan Surat Keterangan pada ' . $company->name . ' di Provinsi Banten, dengan ini Kepala Dinas Tenaga Kerja dan Transmigrasi Provinsi Banten';
        $keperluan = 'Melaksanakan Uji Materi perihal Permohonan Surat Keterangan Pada ' . $company->name . ', hari Senin Tanggal ' . date('d M Y') . ', bertempat di ' . $company->name . ', ' . $company->address;
        $noIdxSpt = $this->getNoIdxSpt();
        $input['no_idx'] = $noIdxSpt;
        $input['suket_id'] = $data->id;
        $input['uraian'] = $uraian;
        $input['city_code'] = 'KAB0006';
        $input['tgl_spt'] = date('Y-m-d');
        $input['keperluan'] = $keperluan;
        $input['created_at'] = date('Y-m-d H:i:s');
        $input['created_by'] = $users->id;
        $input['status'] = 'open';
        $result = $spt->storeData($input);
        if ($result) {
            foreach ($pegawai as $val) {
                DB::table('sim_spt_biodata')->insert([
                    'biodata_id' => $val,
                    'spt_id' => $result->id,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
            $sptRunNo = $this->getNoIdxSpt();

            $sptIdx = str_pad($sptRunNo, 3, '0', STR_PAD_LEFT) . '/' . str_pad($result->id, 3, '0', STR_PAD_LEFT) . '-DTKT/WASNAKER/' . $this->numberToRomanRepresentation(date('m')) . '/' . date('Y');
            DB::table('sim_spt_no')->insert([
                'spt_id' => $result->id,
                'spt_run_no' => $sptRunNo,
                'spt_idx_no' => $sptIdx,
                'category' => 'spt',
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => $users->id
            ]);
            DB::table('sim_spt')
                    ->where('id', $result->id)
                    ->update(['no_idx' => $sptIdx]);
        }
    }

    function getNoIdxSpt() {
        $sptNo = DB::table('sim_spt_no')->where('category', 'spt')->max('spt_run_no');
        return $sptNo + 1;
    }

    function numberToRomanRepresentation($number) {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if ($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }

    public function fetch(Request $request) {
        if ($request->ajax()) {
            $users = Auth::user();
            $data = Suket::select(['a.id',
                        'a.no_surat',
                        'a.tgl_surat',
                        'a.status',
                        'a.company_id',
                        'b.name AS company_name',
                        'a.step',
                        'a.jml_obyek',
                        'c.name AS jenis_obyek'
                    ])
                    ->from('sim_suket AS a')
                    ->leftJoin('m_company AS b', 'b.id', '=', 'a.company_id')
                    ->leftJoin('m_pemeriksaan AS c', 'c.id', '=', 'a.id_pemeriksaan');
            if ($users->role_id == 35) {
                // 35 role pjk3 
                $data->whereIn('a.status', ['terkirim', 'draft']);
                $data->where('a.created_by', $users->id);
            } elseif ($users->role_id == 38) {
                // 38 role kabid 
                $data->where('a.status', 'terkirim');
            } elseif ($users->role_id == 39) {
                // 39 role kepala upt 
                $data->where('a.status', 'terkirim');
                $data->where('biodata_upt_id', $users->biodata_id);
            }
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->filter(function ($instance) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $instance->where(function($w) use($request) {
                                        $search = $request->get('search');
                                        $w->orWhere('a.no_surat', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                        ->orWhere('a.status', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                        ->orWhere('a.tgl_surat', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                        ->orWhere('b.name', 'LIKE', "%" . Str::lower($search['value']) . "%");
                                    });
                                }
                            })
                            ->addColumn('status', function($row) use($users) {
                                $btn = '';
                                if ($row->status == 'draft') {
                                    $btn = '<small class="badge badge-info">Konsep</small>';
                                } elseif ($row->status == 'proses') {
                                    $btn = '<small class="badge badge-warning">Proses</small>';
                                } elseif ($row->status == 'terkirim') {
                                    if ($users->role_id == 35) {
                                        $btn = '<small class="badge badge-info">Terkirim</small>';
                                    } elseif ($users->role_id == 38) {
                                        $btn = '<small class="badge badge-info">Baru</small>';
                                    }
                                } else {
                                    $btn = '<small class="badge badge-success">Terverifikasi</small>';
                                }
                                return $btn;
                            })
                            ->addColumn('action', function($row) use($users) {
                                $id = Crypt::encrypt($row->id);
                                $btn = '';
                                if ($users->role_id == 35) {
                                    if ($row->status == 'draft') {
                                        $btn = '<a href="' . url('admin/pengajuan/create/1/' . $id) . '" data-toggle="tooltip"  data-id="' . $id . '" data-original-title="Edit" class="action-edit mr-1"><i class="fas fa-pencil-alt text-warning"></i></a> ';
                                        $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $id . '" data-original-title="Delete" class="action-delete"><i class="fas fa-trash text-danger"></i></a>';
                                    } else {
                                        $btn = '<i class="fas fa-pencil-alt text-secondary disabled mr-2"></i>';
                                        $btn .= '<i class="fas fa-trash text-secondary disabled"></i>';
                                    }
                                } elseif ($users->role_id == 38) {
                                    $btn = '<a href="' . url('admin/pengajuan/create/1/' . $id) . '" data-toggle="tooltip"  data-id="' . $id . '" data-original-title="Edit" class="action-edit btn btn-sm btn-success mr-1"><i class="fas fa-pencil-alt"></i>&nbsp;Proses</a> ';
                                }
                                return $btn;
                            })
                            ->rawColumns(['status', 'action'])
                            ->orderColumn('no_surat', 'no_surat $1')
                            ->make(true);
        }
    }

    public function destroy($id) {
        $id = Crypt::decrypt($id);
        Suket::find($id)->delete();
        return response()->json(['success' => true]);
    }

}
