<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Renja;
use App\Models\Biodata;
use App\Exports\RenjaExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
use App\Models\Company;
use PDF;
use Auth;
use URL;
use DB;

//use SimpleSoftwareIO\QrCode\Facades\QrCode;
//use DataTables;
/**
 * Description of RenjaController
 *
 * @author heryhandoko
 */
class RenjaController extends Controller {

    //put your code here
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return View('renja.index');
    }

    public function event(Request $request) {

        $users = Auth::user();
        $from = substr($request->start, 0, 10);
        $to = substr($request->end, 0, 10);
        if ($request->menu === 'pegawai') {
            $data = Renja::select(['sim_renja.id', 'm_company.name AS title', 'sim_renja.tgl_pelaksanaan AS start', 'sim_renja.tgl_pelaksanaan AS end', 'sim_renja.status', 'sim_renja.color'])
                    ->leftJoin('m_company', 'm_company.id', '=', 'sim_renja.company_id')
                    ->where('sim_renja.created_by', $users->id)
                    ->whereBetween('sim_renja.tgl_pelaksanaan', [$from, $to])
                    ->get();
        } elseif ($request->menu === 'approver') {
            if ($request->user_id) {
                $data = Renja::select(['sim_renja.id', 'm_company.name AS title', 'sim_renja.tgl_pelaksanaan AS start', 'sim_renja.tgl_pelaksanaan AS end', 'sim_renja.status', 'users.name AS pegawai', 'users.color'])
                        ->leftJoin('m_company', 'm_company.id', '=', 'sim_renja.company_id')
                        ->leftJoin('users', 'users.id', '=', 'sim_renja.created_by')
                        ->where('sim_renja.approval_next', $users->id)
                        ->where('sim_renja.created_by', $request->user_id)
                        ->where('sim_renja.status', 'terkirim')
                        ->whereBetween('sim_renja.tgl_pelaksanaan', [$from, $to])
                        ->get();
            } else {
                $data = Renja::select(['sim_renja.id', 'm_company.name AS title', 'sim_renja.tgl_pelaksanaan AS start', 'sim_renja.tgl_pelaksanaan AS end', 'sim_renja.status', 'users.name AS pegawai', 'users.color'])
                        ->leftJoin('m_company', 'm_company.id', '=', 'sim_renja.company_id')
                        ->leftJoin('users', 'users.id', '=', 'sim_renja.created_by')
                        ->where('sim_renja.approval_next', $users->id)
                        ->where('sim_renja.status', 'terkirim')
                        ->whereBetween('sim_renja.tgl_pelaksanaan', [$from, $to])
                        ->get();
            }
        }
        return response()->json($data);
    }

    public function store(Request $request, Renja $renja) {
        $users = Auth::user();
        $menu = 'pengawas';
        $cek = DB::table('sim_reporting_line')->select(['id'])->where('user_id', $users->id)->first();
        if (!$cek) {
            return response()->json([
                        'success' => false,
                        'menu' => 'composer',
                        'message' => 'Anda belum terdaftar di struktur organisasi'
            ]);
        }
        if ($request->menu == 'approver') {
            $fieldValidate = [
                'status' => ['required']
            ];
            if ($request->status == 'ditolak') {
                $fieldValidate['reason'] = ['required'];
            }
        } else {
            $fieldValidate = [
                'jenis_kegiatan' => ['required', 'string', 'max:500'],
                'type_kegiatan' => ['required', 'string', 'max:500'],
                'company_id' => ['required', 'numeric'],
                'tgl_pelaksanaan' => ['required', 'date_format:Y-m-d'],
                'address' => ['required', 'string', 'max:500'],
            ];
        }
        $validator = \Validator::make($request->all(), $fieldValidate);
        if ($validator->fails()) {
            return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->toArray()
                            ], 422);
        }
        if ($request->menu == 'approver') {
            $id = $request->id;
            $dataRenja = $renja->find($id);
            $getNextApprover = DB::table('sim_renja_approval')
                    ->where('id_renja', $request->id)
                    ->where('approval_id', '!=', $dataRenja->approval_next)
                    ->where('status', 'open')
                    ->orderBy('id', 'asc')
                    ->first();
            if ($getNextApprover && $request->status == 'disetujui') {
                $dataRenja->approval_next = $getNextApprover->approval_id;
                DB::table('sim_renja_approval')->where([
                    'id_renja' => $id,
                    'approval_id' => $users->id
                ])->update([
                    'status' => 'close'
                ]);
            } elseif ($getNextApprover && $request->status == 'ditolak') {
                $dataRenja->approval_next = 0;
                $dataRenja->status = $request->status;
                $dataRenja->reason = $request->reason;
                DB::table('sim_renja_approval')->where([
                    'id_renja' => $id,
                    'approval_id' => $users->id
                ])->update([
                    'status' => 'reject',
                    'description' => $request->reason
                ]);
            } elseif (!$getNextApprover && $request->status == 'disetujui') {
                $dataRenja->approval_next = 9999;
                $dataRenja->status = $request->status;
                DB::table('sim_renja_approval')->where([
                    'id_renja' => $id,
                    'approval_id' => $users->id
                ])->update([
                    'status' => 'close'
                ]);
                static::generateSpt($dataRenja);
            } elseif (!$getNextApprover && $request->status == 'ditolak') {
                $dataRenja->approval_next = 0;
                $dataRenja->status = $request->status;
                $dataRenja->reason = $request->reason;
                DB::table('sim_renja_approval')->where([
                    'id_renja' => $id,
                    'approval_id' => $users->id
                ])->update([
                    'status' => 'reject',
                    'description' => $request->reason
                ]);
            }
            $dataRenja->updated_at = date('Y-m-d H:i:s');
            $dataRenja->updated_by = $users->id;
            $dataRenja->save();
        } else {
            $data = $renja->create([
                'jenis_kegiatan' => $request->jenis_kegiatan,
                'type_kegiatan' => $request->type_kegiatan,
                'company_id' => $request->company_id,
                'keterangan' => $request->keterangan,
                'tgl_pelaksanaan' => $request->tgl_pelaksanaan,
                'created_by' => $users->id,
                'created_at' => date('Y-m-d H:i:s'),
                'status' => 'terkirim',
                'color' => '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6)
            ]);
            $id = $data->id;
            if ($id) {
                $this->setApproval($id, 0, 0);
            }
        }
        if ($id) {
            return response()->json([
                        'success' => true,
                        'menu' => $menu,
                        'message' => 'Buat Rencana Kerja Berhasil'
            ]);
        } else {
            return response()->json([
                        'success' => false,
                        'menu' => $menu,
                        'message' => 'Buat Rencana Kerja Gagal'
            ]);
        }
    }

    public function address(Request $request) {
        $data = \App\Models\Company::select(['address'])->where('id', $request->id)->first();
        return response()->json(
                        [
                            'success' => true,
                            'data' => $data
                        ], 200);
    }

    public function edit($id) {
        $renja = Renja::select(['sim_renja.*', 'm_company.address'])->join('m_company', 'm_company.id', '=', 'sim_renja.company_id')->find($id);
        return response()->json($renja);
    }

    public function cetak(Request $request) {
        date_default_timezone_set("Asia/Bangkok");
        ini_set('memory_limit', '1024M');
        ini_set('upload_max_filesize', '1024M');
        ini_set('post_max_size', '1024M');
        $configs = [
            'title' => 'Rencana Kerja',
            'format' => 'A4',
            'orientation' => 'P',
            'author' => '',
            'watermark' => '',
            'show_watermark' => false,
            'show_watermark_image' => false,
        ];

        $users = Auth::user();
        $biodata = Biodata::select([
                    'a.id',
                    'a.name',
                    'a.nip',
                    'b.name AS golongan',
                    'c.name AS pangkat',
                    'd.name AS jabatan'
                ])
                ->from('sim_biodata AS a')
                ->leftJoin('m_golongan AS b', 'b.golongan_code', '=', 'a.golongan_code')
                ->leftJoin('m_pangkat AS c', 'c.pangkat_code', '=', 'a.pangkat_code')
                ->leftJoin('m_jabatan AS d', 'd.jabatan_code', '=', 'a.jabatan_code')
                ->where('a.id', $users->biodata_id)
                ->first();
        $renja = Renja::select([
                    'sim_renja.id',
                    'sim_renja.jenis_kegiatan',
                    'sim_renja.type_kegiatan',
                    'sim_renja.tgl_pelaksanaan',
                    'm_company.name AS perusahaan',
                    'm_company.address AS alamat',
                    'sim_renja.tgl_pelaksanaan',
                    'sim_renja.keterangan'
                ])
                ->leftJoin('m_company', 'm_company.id', '=', 'sim_renja.company_id')
                ->where('sim_renja.created_by', $users->id)
                ->whereYear('sim_renja.tgl_pelaksanaan', $request->y)
                ->whereMonth('sim_renja.tgl_pelaksanaan', $request->m)
                ->get();
//        $qrcode = QrCode::encoding('UTF-8')->size(80)->generate('renja_' . $users->id . '_' . $request->m . '_' . $request->y);
        $pdf = PDF::loadView('renja.cetak', [
                    'users' => $users,
                    'biodata' => $biodata,
                    'renja' => $renja,
                    'month' => str_pad($request->m, 2, "0", STR_PAD_LEFT),
                    'year' => $request->y,
                    'tanggal' => $request->y . '-' . str_pad($request->m, 2, "0", STR_PAD_LEFT) . '-01',
                        ], [], $configs);
        $filename = 'renja_' . $users->id . '_' . $request->m . '_' . $request->y . '.pdf';
        $pdf->save(public_path('pdf/renja/' . $filename));
        $response = [
            'status' => 'success',
            'data' => [
                'url' => URL::to('pdf/renja/' . $filename)
            ]
        ];
        return response()->json($response);
    }

    public function view($month, $year) {
        $users = Auth::user();
        $biodata = Biodata::select([
                    'a.id',
                    'a.name',
                    'a.nip',
                    'b.name AS golongan',
                    'c.name AS pangkat',
                    'd.name AS jabatan'
                ])
                ->from('sim_biodata AS a')
                ->leftJoin('m_golongan AS b', 'b.golongan_code', '=', 'a.golongan_code')
                ->leftJoin('m_pangkat AS c', 'c.pangkat_code', '=', 'a.pangkat_code')
                ->leftJoin('m_jabatan AS d', 'd.jabatan_code', '=', 'a.jabatan_code')
                ->where('a.id', $users->biodata_id)
                ->first();
        $renja = Renja::select([
                    'sim_renja.id',
                    'sim_renja.jenis_kegiatan',
                    'sim_renja.type_kegiatan',
                    'sim_renja.tgl_pelaksanaan',
                    'm_company.name AS perusahaan',
                    'm_company.address AS alamat',
                    'sim_renja.tgl_pelaksanaan',
                    'sim_renja.keterangan'
                ])
                ->leftJoin('m_company', 'm_company.id', '=', 'sim_renja.company_id')
                ->where('sim_renja.created_by', $users->id)
                ->whereYear('sim_renja.tgl_pelaksanaan', $year)
                ->whereMonth('sim_renja.tgl_pelaksanaan', $month)
                ->get();
        return View('renja.view', [
            'users' => $users,
            'biodata' => $biodata,
            'renja' => $renja,
            'month' => str_pad($month, 2, "0", STR_PAD_LEFT),
            'year' => $year,
            'tanggal' => $year . '-' . str_pad($month, 2, "0", STR_PAD_LEFT) . '-01',
        ]);
    }

    public function export_excel(Request $request) {
        $users = Auth::user();
        $filename = 'renja_' . $users->id . '_' . $request->m . '_' . $request->y . '.xls';
        return Excel::download(new RenjaExport($request), $filename);
    }

    public function chartbar() {
        $users = Auth::user();
        if ($users->role_id == 39) {
            $proses = DB::table('sys_month')
                    ->leftJoin('sim_renja', function ($join) {
                        $join->on(DB::raw('MONTH(sim_renja.tgl_pelaksanaan)'), '=', 'sys_month.id')
                        ->where('sim_renja.status', 'approve_upt')
                        ->whereYear('sim_renja.tgl_pelaksanaan', date('Y'));
                    })
                    ->select(DB::raw('sys_month.id,sys_month.code,COUNT(sim_renja.id) AS total'))
                    ->groupBy('sys_month.id', 'sys_month.code')
                    ->get();

            $pengajuan = DB::table('sys_month')
                    ->leftJoin('sim_renja', function ($join) {
                        $join->on(DB::raw('MONTH(sim_renja.tgl_pelaksanaan)'), '=', 'sys_month.id')
                        ->where('sim_renja.status', 'terkirim')
                        ->whereYear('sim_renja.tgl_pelaksanaan', date('Y'));
                    })
                    ->select(DB::raw('sys_month.id,sys_month.code,COUNT(sim_renja.id) AS total'))
                    ->groupBy('sys_month.id', 'sys_month.code')
                    ->get();

            $terverifikasi = DB::table('sys_month')
                    ->leftJoin('sim_renja', function ($join) {
                        $join->on(DB::raw('MONTH(sim_renja.tgl_pelaksanaan)'), '=', 'sys_month.id')
                        ->where('sim_renja.status', 'reject_upt')
                        ->whereYear('sim_renja.tgl_pelaksanaan', date('Y'));
                    })
                    ->select(DB::raw('sys_month.id,sys_month.code,COUNT(sim_renja.id) AS total'))
                    ->groupBy('sys_month.id', 'sys_month.code')
                    ->get();
        } elseif ($users->role_id == 38) {
            $proses = DB::table('sys_month')
                    ->leftJoin('sim_renja', function ($join) {
                        $join->on(DB::raw('MONTH(sim_renja.tgl_pelaksanaan)'), '=', 'sys_month.id')
                        ->where('sim_renja.status', 'disetujui')
                        ->whereYear('sim_renja.tgl_pelaksanaan', date('Y'));
                    })
                    ->select(DB::raw('sys_month.id,sys_month.code,COUNT(sim_renja.id) AS total'))
                    ->groupBy('sys_month.id', 'sys_month.code')
                    ->get();

            $pengajuan = DB::table('sys_month')
                    ->leftJoin('sim_renja', function ($join) {
                        $join->on(DB::raw('MONTH(sim_renja.tgl_pelaksanaan)'), '=', 'sys_month.id')
                        ->where('sim_renja.status', 'approve_upt')
                        ->whereYear('sim_renja.tgl_pelaksanaan', date('Y'));
                    })
                    ->select(DB::raw('sys_month.id,sys_month.code,COUNT(sim_renja.id) AS total'))
                    ->groupBy('sys_month.id', 'sys_month.code')
                    ->get();

            $terverifikasi = DB::table('sys_month')
                    ->leftJoin('sim_renja', function ($join) {
                        $join->on(DB::raw('MONTH(sim_renja.tgl_pelaksanaan)'), '=', 'sys_month.id')
                        ->where('sim_renja.status', 'ditolak')
                        ->whereYear('sim_renja.tgl_pelaksanaan', date('Y'));
                    })
                    ->select(DB::raw('sys_month.id,sys_month.code,COUNT(sim_renja.id) AS total'))
                    ->groupBy('sys_month.id', 'sys_month.code')
                    ->get();
        } else {
            $proses = DB::table('sys_month')
                    ->leftJoin('sim_renja', function ($join) {
                        $user = Auth::user();
                        $join->on(DB::raw('MONTH(sim_renja.tgl_pelaksanaan)'), '=', 'sys_month.id')
                        ->where('sim_renja.created_by', '=', $user->id)
                        ->where('sim_renja.status', 'disetujui')
                        ->whereYear('sim_renja.tgl_pelaksanaan', date('Y'));
                    })
                    ->select(DB::raw('sys_month.id,sys_month.code,COUNT(sim_renja.id) AS total'))
                    ->groupBy('sys_month.id', 'sys_month.code')
                    ->get();

            $pengajuan = DB::table('sys_month')
                    ->leftJoin('sim_renja', function ($join) {
                        $user = Auth::user();
                        $join->on(DB::raw('MONTH(sim_renja.tgl_pelaksanaan)'), '=', 'sys_month.id')
                        ->where('sim_renja.created_by', '=', $user->id)
                        ->where('sim_renja.status', 'proses')
                        ->whereYear('sim_renja.tgl_pelaksanaan', date('Y'));
                    })
                    ->select(DB::raw('sys_month.id,sys_month.code,COUNT(sim_renja.id) AS total'))
                    ->groupBy('sys_month.id', 'sys_month.code')
                    ->get();

            $terverifikasi = DB::table('sys_month')
                    ->leftJoin('sim_renja', function ($join) {
                        $user = Auth::user();
                        $join->on(DB::raw('MONTH(sim_renja.tgl_pelaksanaan)'), '=', 'sys_month.id')
                        ->where('sim_renja.created_by', '=', $user->id)
                        ->where('sim_renja.status', 'ditolak')
                        ->whereYear('sim_renja.tgl_pelaksanaan', date('Y'));
                    })
                    ->select(DB::raw('sys_month.id,sys_month.code,COUNT(sim_renja.id) AS total'))
                    ->groupBy('sys_month.id', 'sys_month.code')
                    ->get();
        }

        $bulan = [];
        $bbn1 = [];
        $bbn2 = [];
        $bbn3 = [];
        foreach ($proses as $key => $val) {
            $bulan[] = $val->code;
            $bbn1[] = $proses[$key]->total;
            $bbn2[] = $pengajuan[$key]->total;
            $bbn3[] = $terverifikasi[$key]->total;
        }
        return response()->json([
                    'success' => true,
                    'data' => [
                        'labels' => $bulan,
                        'datasets2' => [
                            [
                                'data' => $bbn1,
                                'backgroundColor' => '#28a745',
                                'borderColor' => '#28a745',
                            ],
                            [
                                'data' => $bbn2,
                                'backgroundColor' => '#ffc107',
                                'borderColor' => '#ffc107',
                            ],
                            [
                                'data' => $bbn3,
                                'backgroundColor' => '#dc3545',
                                'borderColor' => '#dc3545',
                            ]
                        ]
                    ]
        ]);
    }

    public function chartpie() {
        $user = Auth::user();
        if ($user->role_id == 39) {
            $dataR1 = DB::table('sim_renja')
                    ->select(DB::raw('sim_renja.status,COUNT(sim_renja.id) AS total'))
                    ->whereYear('sim_renja.tgl_pelaksanaan', date('Y'))
                    ->groupBy('sim_renja.status')
                    ->get();
        } elseif ($user->role_id == 38) {
            $dataR1 = DB::table('sim_renja')
                    ->select(DB::raw('sim_renja.status,COUNT(sim_renja.id) AS total'))
                    ->whereYear('sim_renja.tgl_pelaksanaan', date('Y'))
                    ->groupBy('sim_renja.status')
                    ->get();
        } else {
            $dataR1 = DB::table('sim_renja')
                    ->select(DB::raw('sim_renja.status,COUNT(sim_renja.id) AS total'))
                    ->where('sim_renja.created_by', '=', $user->id)
                    ->whereYear('sim_renja.tgl_pelaksanaan', date('Y'))
                    ->groupBy('sim_renja.status')
                    ->get();
        }
        $labels = [];
        $status = [];
        foreach ($dataR1 as $key => $val) {
            $labels[] = $val->status;
            $status[] = $val->total;
        }
        return response()->json([
                    'success' => true,
                    'data' => [
                        'labels' => $labels,
                        'status' => $status
                    ]
        ]);
    }

    public function persetujuan() {
        $user = Auth::user();
        $pegawai = DB::table('sim_renja')
                ->select(['sim_biodata.name AS pegawai', 'users.color', 'users.id AS user_id'])
                ->distinct()
                ->join('users', 'users.id', '=', 'sim_renja.created_by')
                ->join('sim_biodata', 'sim_biodata.id', '=', 'users.biodata_id')
                ->where('sim_renja.status', 'terkirim')
                ->where('sim_renja.approval_next', $user->id)
                ->get();
        return View('renja.persetujuan', [
            'pegawai' => $pegawai,
            'menu' => 'approver'
        ]);
    }

    public function company(Request $request) {
        $page = $request->page;
        $term = trim($request->term);
        $resultCount = 25;

        $offset = ($page - 1) * $resultCount;
        $user = Auth::user();
        $company = Company::where('m_company.name', 'LIKE', '%' . strtolower($term) . '%')
                ->join('sim_upt_company', 'sim_upt_company.company_id', '=', 'm_company.id')
                ->join('sim_user_upt', 'sim_user_upt.upt_id', '=', 'sim_upt_company.upt_id')
                ->where('sim_user_upt.biodata_id', $user->biodata_id)
                ->whereNotIn('m_company.id', function($query) {
                    $query->select('company_id')
                    ->from('sim_renja')
                    ->where('status', '!=', 'reject');
                })
                ->skip($offset)
                ->take($resultCount)
                ->get(['m_company.id', DB::raw('m_company.name as text')]);

        $count = Count(Company::where('m_company.name', 'LIKE', '%' . strtolower($term) . '%')
                        ->whereNotIn('id', function($query) {
                            $query->select('company_id')
                            ->from('sim_renja')
                            ->where('status', '!=', 'reject_upt');
                        })
                        ->get(['m_company.id', DB::raw('m_company.name as text')]));
        $endCount = $offset + $resultCount;
        $morePages = $count > $endCount;

        return response()->json([
                    'results' => $company,
                    'pagination' => [
                        'more' => $morePages
                    ]
        ]);
    }

    public function setApproval($renjaId, $idx, $parentId) {
        $table = 'sim_reporting_line';
        $field = ['parent_id', 'user_id'];
        if ($idx == 0) {
            $user = Auth::user();
            $result = DB::table($table)->select($field)->where('user_id', $user->id)->first();
            if ($result) {
                static::insertApproval($renjaId, $result, 'close');
                $parentId = $result->parent_id;
                if ($parentId) {
                    $idx++;
                    $this->setApproval($renjaId, $idx, $parentId);
                }
            } else {
                return false;
            }
        } else {
            $struct = DB::table($table)->select($field)->where('id', $parentId)->first();
            if ($struct) {
                static::insertApproval($renjaId, $struct, 'open');
                if ($idx == 1) {
                    Renja::where('id', $renjaId)->update(['approval_next' => $struct->user_id]);
                }
                if ($struct->parent_id > 0) {
                    $idx++;
                    $this->setApproval($renjaId, $idx, $struct->parent_id);
                }
            }
        }
        return true;
    }

    private static function insertApproval($renjaId, $struct, $status) {
        DB::table('sim_renja_approval')->insert([
            'id_renja' => $renjaId,
            'status' => $status,
            'description' => '',
            'approval_id' => $struct->user_id,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $struct->user_id,
        ]);
    }

    protected static function generateSpt($data) {
        $noIdxSpt = static::getNoIdxSpt('spt');
        $user = Auth::user();
        $tmpSpt = DB::table('m_templates')->select('content')->where('id', 1)->first();
        $sptNo = '800/' . str_pad($noIdxSpt, 3, '0', STR_PAD_LEFT) . '-UPTDPK/' . static::numberToRomanRepresentation(date('m')) . '/' . date('Y');

        $biodata = Biodata::select([
                    'a.id',
                    'a.name',
                    'a.nip',
                    'a.phone',
                    'b.name AS golongan',
                    'c.name AS pangkat',
                    'd.name AS jabatan'
                ])
                ->from('sim_biodata AS a')
                ->leftJoin('m_golongan AS b', 'b.golongan_code', '=', 'a.golongan_code')
                ->leftJoin('m_pangkat AS c', 'c.pangkat_code', '=', 'a.pangkat_code')
                ->leftJoin('m_jabatan AS d', 'd.jabatan_code', '=', 'a.jabatan_code')
                ->leftJoin('users AS e', 'e.biodata_id', '=', 'a.id')
                ->where('e.id', $data->created_by)
                ->first();
        $renja = Renja::select([
                    'sim_renja.id',
                    'sim_renja.jenis_kegiatan',
                    'sim_renja.type_kegiatan',
                    'sim_renja.tgl_pelaksanaan',
                    'm_company.name AS perusahaan',
                    'm_company.address AS alamat',
                    'sim_renja.tgl_pelaksanaan',
                    'sim_renja.keterangan'
                ])
                ->leftJoin('m_company', 'm_company.id', '=', 'sim_renja.company_id')
                ->where('sim_renja.id', $data->id)
                ->first();
        $description = $tmpSpt->content;
        $description = str_replace("_varNomorSpt_", $sptNo, $description);
        $description = str_replace("_varNamaNipSpt_", $biodata->name . '/' . $biodata->nip, $description);
        $description = str_replace("_varPangkatGolSpt_", $biodata->pangkat . '/' . $biodata->golongan, $description);
        $description = str_replace("_varJabatanSpt_", $biodata->jabatan, $description);
        $description = str_replace("_varJenisKegiatanSpt_", 'Melakukan ' . $renja->jenis_kegiatan . ' Ketenagakerjaan', $description);
        $description = str_replace("_varPerusahaanSpt_", $renja->perusahaan, $description);
        $description = str_replace("_varAlamatSpt_", $renja->alamat, $description);
        $description = str_replace("_varHariSpt_", Carbon::parse($renja->tgl_pelaksanaan)->locale('id')->dayName, $description);
        $description = str_replace("_varTanggalKegiatanSpt_", Carbon::parse($renja->tgl_pelaksanaan)->locale('id')->isoFormat('D MMMM Y'), $description);
        $description = str_replace("_varTanggalSpt_", Carbon::parse(date('Y-m-d'))->locale('id')->isoFormat('D MMMM Y'), $description);

        $input['no_idx'] = $sptNo;
        $input['uraian'] = $description;
        $input['renja_id'] = $data->id;
        $input['tgl_spt'] = $data->tgl_pelaksanaan;
        $input['status'] = 'disetujui';
        $input['created_at'] = date('Y-m-d H:i:s');
        $input['created_by'] = $data->created_by;
        $spt = \App\Models\Spt::create($input);
        static::generateNotif($data, $noIdxSpt, $user, $renja, $biodata);
        DB::table('sim_spt_no')->insert([
            'spt_id' => $spt->id,
            'spt_run_no' => $noIdxSpt,
            'spt_idx_no' => $sptNo,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $user->id,
            'category' => 'spt'
        ]);
    }

    protected static function generateNotif($data, $noIdxSpt, $user, $renja, $biodata) {
        $tmpSpt = DB::table('m_templates')->select('content')->where('id', 2)->first();
        $notifNo = '560/' . str_pad($noIdxSpt, 3, '0', STR_PAD_LEFT) . '-UPTDPK/' . static::numberToRomanRepresentation(date('m')) . '/' . date('Y');

        $description = $tmpSpt->content;
        $description = str_replace("_varTglPemberitahuan_", Carbon::parse(date('Y-m-d'))->locale('id')->isoFormat('D MMMM Y'), $description);
        $description = str_replace("_varNomorPemberitahuan_", $notifNo, $description);
        $description = str_replace("_varPerusahaanPemberitahuan_", $renja->perusahaan, $description);
        $description = str_replace("_varHariTglPemberitahuan_", Carbon::parse($renja->tgl_pelaksanaan)->locale('id')->dayName . ', ' . Carbon::parse($renja->tgl_pelaksanaan)->locale('id')->isoFormat('D MMMM Y'), $description);
        $description = str_replace("_varWaktuPemberitahuan_", '09:00 WIB s/d Selesei', $description);
        $description = str_replace("_varPetugasPemberitahuan_", $biodata->name . '/' . $biodata->jabatan, $description);
        $description = str_replace("_varContactPemberitahuan_", $biodata->phone, $description);

        $input['no_idx'] = $notifNo;
        $input['uraian'] = $description;
        $input['tgl_notif'] = $data->tgl_pelaksanaan;
        $input['created_at'] = date('Y-m-d H:i:s');
        $input['created_by'] = $data->created_by;
        $input['renja_id'] = $data->id;
        $input['status'] = 'disetujui';
        $notif = \App\Models\Pemberitahuan::create($input);
        DB::table('sim_spt_no')->insert([
            'spt_id' => $notif->id,
            'spt_run_no' => $noIdxSpt,
            'spt_idx_no' => $notifNo,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $user->id,
            'category' => 'pemberitahuan'
        ]);
    }

    protected static function getNoIdxSpt($category) {
        $sptNo = DB::table('sim_spt_no')->where('category', $category)->max('spt_run_no');
        return $sptNo + 1;
    }

    protected static function numberToRomanRepresentation($number) {
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

}
