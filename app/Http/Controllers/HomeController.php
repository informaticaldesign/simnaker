<?php

namespace App\Http\Controllers;

use DB;
use Auth;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->role_id == 35) {
            $pengajuan = \App\Models\Suket::where('company_id', $user->company_id)->count();
            $proses = \App\Models\Suket::where('status', 'proses')->where('company_id', $user->company_id)->count();
            $terverifikasi = \App\Models\Suket::where('status', 'terverifikasi')->where('company_id', $user->company_id)->count();
            $inbox = 0;
            $profile = \App\Models\Company::where('id', $user->company_id)->first();
            return view('pjk3.home', [
                'pengajuan' => $pengajuan,
                'proses' => $proses,
                'terverifikasi' => $terverifikasi,
                'inbox' => $inbox,
                'profile' => $profile,
            ]);
        } elseif ($user->role_id == 34) {
            if (!$user->biodata_id) {
                return redirect()->route('profile');
            } else {
                $rjall = \App\Models\Renja::where('created_by', $user->id)->whereYear('tgl_pelaksanaan', date('Y'))->count();
                $rjwaiting = \App\Models\Renja::where('status', 'proses')->whereYear('tgl_pelaksanaan', date('Y'))->where('created_by', $user->id)->count();
                $rjapprove = \App\Models\Renja::where('status', 'disetujui')->where('created_by', $user->id)->whereYear('tgl_pelaksanaan', date('Y'))->count();
                $rjreject = \App\Models\Renja::where('status', 'ditolak')->whereYear('tgl_pelaksanaan', date('Y'))->where('created_by', $user->id)->count();
                $profile = \App\Models\Biodata::where('id', $user->biodata_id)->first();
                if ($profile) {
                    return view('dashboard.pengawas', [
                        'rjall' => $rjall,
                        'rjwaiting' => $rjwaiting,
                        'rjapprove' => $rjapprove,
                        'rjreject' => $rjreject,
                        'profile' => $profile,
                        'users' => $user
                    ]);
                } else {
                    return redirect()->route('profile');
                }
            }
        } elseif ($user->role_id == 37) {
            if (!$user->biodata_id) {
                return redirect()->route('profile');
            } else {
                $users = \App\Models\User::count();
                $company = \App\Models\Company::count();
                $visitor = \App\Models\Visitors::count();
                $profile = \App\Models\Biodata::where('id', $user->biodata_id)->first();
                return view('dashboard.admin', [
                    'user' => $users,
                    'company' => $company,
                    'visitor' => $visitor,
                    'inbox' => 0,
                    'profile' => $profile,
                    'users' => $user
                ]);
            }
        } elseif ($user->role_id == 38) {
            if (!$user->biodata_id) {
                return redirect()->route('profile');
            } else {
                $rjall = \App\Models\Renja::where('created_by', $user->id)->whereYear('tgl_pelaksanaan', date('Y'))->count();
                $rjwaiting = \App\Models\Renja::where('status', 'approve_upt')->whereYear('tgl_pelaksanaan', date('Y'))->count();
                $rjapprove = \App\Models\Renja::where('status', 'disetujui')->whereYear('tgl_pelaksanaan', date('Y'))->count();
                $rjreject = \App\Models\Renja::where('status', 'ditolak')->whereYear('tgl_pelaksanaan', date('Y'))->count();
                $profile = \App\Models\Biodata::where('id', $user->biodata_id)->first();
                return view('dashboard.kabid', [
                    'rjall' => $rjall,
                    'rjwaiting' => $rjwaiting,
                    'rjapprove' => $rjapprove,
                    'rjreject' => $rjreject,
                    'profile' => $profile,
                    'users' => $user
                ]);
            }
        } elseif ($user->role_id == 39) {
            if (!$user->biodata_id) {
                return redirect()->route('profile');
            } else {
                $rjall = \App\Models\Renja::where('created_by', $user->id)->whereYear('tgl_pelaksanaan', date('Y'))->count();
                $rjwaiting = \App\Models\Renja::where('status', 'terkirim')->whereYear('tgl_pelaksanaan', date('Y'))->count();
                $rjapprove = \App\Models\Renja::where('status', 'approve_upt')->whereYear('tgl_pelaksanaan', date('Y'))->count();
                $rjreject = \App\Models\Renja::where('status', 'reject_upt')->whereYear('tgl_pelaksanaan', date('Y'))->count();
                $profile = \App\Models\Biodata::where('id', $user->biodata_id)->first();
                return view('dashboard.kabid', [
                    'rjall' => $rjall,
                    'rjwaiting' => $rjwaiting,
                    'rjapprove' => $rjapprove,
                    'rjreject' => $rjreject,
                    'profile' => $profile,
                    'users' => $user
                ]);
            }
        } elseif ($user->role_id == 41) {
            if (!$user->biodata_id) {
                return redirect()->route('profile');
            } else {
                $bbnw = DB::table('bbns')->where('status', 'WAITING')->count();
                $bbnp = DB::table('bbns')->where('status', 'BERHASIL')->count();
                $bbnt = DB::table('bbns')->count();
                $transw = DB::table('transaksis')->where('status', 'WAITING')->count();
                $transp = DB::table('transaksis')->where('status', 'BERHASIL')->count();
                $transt = DB::table('transaksis')->count();
                return view('home', [
                    'bbnw' => $bbnw,
                    'bbnp' => $bbnp,
                    'transw' => $transw,
                    'transp' => $transp,
                    'bbnt' => $bbnt,
                    'transt' => $transt,
                    'users' => $user
                ]);
            }
        } else {
            $bbnw = DB::table('bbns')->where('status', 'WAITING')->count();
            $bbnp = DB::table('bbns')->where('status', 'BERHASIL')->count();
            $bbnt = DB::table('bbns')->count();
            $transw = DB::table('transaksis')->where('status', 'WAITING')->count();
            $transp = DB::table('transaksis')->where('status', 'BERHASIL')->count();
            $transt = DB::table('transaksis')->count();
            return view('home', [
                'bbnw' => $bbnw,
                'bbnp' => $bbnp,
                'transw' => $transw,
                'transp' => $transp,
                'bbnt' => $bbnt,
                'transt' => $transt,
                'users' => $user
            ]);
        }
    }

    public function dtrans()
    {
        $dataR2 = DB::table('sys_month')
            ->leftJoin('sim_suket', function ($join) {
                $join->on(DB::raw('MONTH(sim_suket.created_at)'), '=', 'sys_month.id')
                    ->where('sim_suket.status', '=', 'proses')
                    ->where(DB::raw('YEAR (sim_suket.created_at)'), '=', date('Y'));
            })
            ->select(DB::raw('sys_month.id,sys_month.code,COUNT(sim_suket.id) AS total'))
            ->groupBy('sys_month.id', 'sys_month.code')
            ->get();
        //        $dataR4 = DB::table('sys_month')
        //                ->leftJoin('transaksis', function ($join) {
        //                    $join->on(DB::raw('MONTH(transaksis.created_at)'), '=', 'sys_month.id')
        //                    ->where('transaksis.jenis_id', '=', 2)
        //                    ->where(DB::raw('YEAR (transaksis.created_at)'), '=', date('Y'));
        //                })
        //                ->select(DB::raw('sys_month.id,sys_month.code,COUNT(transaksis.id) AS total'))
        //                ->groupBy('sys_month.id', 'sys_month.code')
        //                ->get();
        //        $dataR3 = DB::table('sys_month')
        //                ->leftJoin('transaksis', function ($join) {
        //                    $join->on(DB::raw('MONTH(transaksis.created_at)'), '=', 'sys_month.id')
        //                    ->where('transaksis.jenis_id', '=', 4)
        //                    ->where(DB::raw('YEAR (transaksis.created_at)'), '=', date('Y'));
        //                })
        //                ->select(DB::raw('sys_month.id,sys_month.code,COUNT(transaksis.id) AS total'))
        //                ->groupBy('sys_month.id', 'sys_month.code')
        //                ->get();
        $bbnR2 = DB::table('sys_month')
            ->leftJoin('sim_suket', function ($join) {
                $join->on(DB::raw('MONTH(bbns.created_at)'), '=', 'sys_month.id')
                    ->where('sim_suket.status', '=', 'proses')
                    ->where(DB::raw('YEAR (sim_suket.created_at)'), '=', date('Y'));
            })
            ->select(DB::raw('sys_month.id,sys_month.code,COUNT(sim_suket.id) AS total'))
            ->groupBy('sys_month.id', 'sys_month.code')
            ->get();
        //        $bbnR4 = DB::table('sys_month')
        //                ->leftJoin('bbns', function ($join) {
        //                    $join->on(DB::raw('MONTH(bbns.created_at)'), '=', 'sys_month.id')
        //                    ->where('bbns.jenis_id', '=', 2)
        //                    ->where(DB::raw('YEAR (bbns.created_at)'), '=', date('Y'));
        //                })
        //                ->select(DB::raw('sys_month.id,sys_month.code,COUNT(bbns.id) AS total'))
        //                ->groupBy('sys_month.id', 'sys_month.code')
        //                ->get();
        //        $bbnR3 = DB::table('sys_month')
        //                ->leftJoin('bbns', function ($join) {
        //                    $join->on(DB::raw('MONTH(bbns.created_at)'), '=', 'sys_month.id')
        //                    ->where('bbns.jenis_id', '=', 4)
        //                    ->where(DB::raw('YEAR (bbns.created_at)'), '=', date('Y'));
        //                })
        //                ->select(DB::raw('sys_month.id,sys_month.code,COUNT(bbns.id) AS total'))
        //                ->groupBy('sys_month.id', 'sys_month.code')
        //                ->get();
        $bulan = [];
        $jenis1 = [];
        //        $jenis2 = [];
        //        $jenis3 = [];
        $bbn1 = [];
        //        $bbn2 = [];
        //        $bbn3 = [];
        foreach ($dataR2 as $key => $val) {
            $bulan[] = $val->code;
            $jenis1[] = $val->total;
            //            $jenis2[] = $dataR4[$key]->total;
            //            $jenis3[] = $dataR3[$key]->total;

            $bbn1[] = $bbnR2[$key]->total;
            //            $bbn2[] = $bbnR4[$key]->total;
            //            $bbn3[] = $bbnR3[$key]->total;
        }
        return response()->json([
            'success' => true,
            'data' => [
                'labels' => $bulan,
                'datasets1' => [
                    [
                        'data' => $jenis1,
                        'type' => 'line',
                        'backgroundColor' => 'transparent',
                        'borderColor' => '#007bff',
                        'pointBorderColor' => '#007bff',
                        'pointBackgroundColor' => '#007bff',
                        'fill' => false,
                    ],
                    //                            [
                    //                                'data' => $jenis2,
                    //                                'type' => 'line',
                    //                                'backgroundColor' => 'transparent',
                    //                                'borderColor' => '#dc3545',
                    //                                'pointBorderColor' => '#dc3545',
                    //                                'pointBackgroundColor' => '#dc3545',
                    //                                'fill' => false,
                    //                            ],
                    //                            [
                    //                                'data' => $jenis3,
                    //                                'type' => 'line',
                    //                                'backgroundColor' => 'transparent',
                    //                                'borderColor' => '#dc3545',
                    //                                'pointBorderColor' => '#ffc107',
                    //                                'pointBackgroundColor' => '#ffc107',
                    //                                'fill' => false,
                    //                            ]
                ],
                'datasets2' => [
                    [
                        'data' => $bbn1,
                        'backgroundColor' => '#007bff',
                        'borderColor' => '#007bff',
                    ],
                    //                            [
                    //                                'data' => $bbn2,
                    //                                'backgroundColor' => '#dc3545',
                    //                                'borderColor' => '#dc3545',
                    //                            ],
                    //                            [
                    //                                'data' => $bbn3,
                    //                                'backgroundColor' => '#ffc107',
                    //                                'borderColor' => '#ffc107',
                    //                            ]
                ]
            ]
        ]);
    }

    public function dbbn()
    {
        $dataR1 = DB::table('sys_status')
            ->leftJoin('bbns', 'bbns.status', '=', 'sys_status.code')
            ->select(DB::raw('sys_status.code,COUNT(bbns.id) AS total'))
            ->groupBy('sys_status.code')
            ->get();
        $labels = [];
        $status = [];
        foreach ($dataR1 as $key => $val) {
            $labels[] = $val->code;
            $status[] = $val->total;
        }

        $dataR2 = DB::table('sys_status')
            ->leftJoin('transaksis', 'transaksis.status', '=', 'sys_status.code')
            ->select(DB::raw('sys_status.code,COUNT(transaksis.id) AS total'))
            ->groupBy('sys_status.code')
            ->get();
        $labels2 = [];
        $status2 = [];
        foreach ($dataR2 as $key => $val) {
            $labels2[] = $val->code;
            $status2[] = $val->total;
        }
        return response()->json([
            'success' => true,
            'data' => [
                'labels' => $labels,
                'status' => $status
            ],
            'datax' => [
                'labels' => $labels2,
                'status' => $status2
            ],
        ]);
    }

    public function pengajuan()
    {

        $proses = DB::table('sys_month')
            ->leftJoin('sim_suket', function ($join) {
                $user = Auth::user();
                $join->on(DB::raw('MONTH(sim_suket.tgl_surat)'), '=', 'sys_month.id')
                    ->where('sim_suket.company_id', '=', $user->company_id)
                    ->where(DB::raw('YEAR (sim_suket.tgl_surat)'), '=', date('Y'));
            })
            ->select(DB::raw('sys_month.id,sys_month.code,COUNT(sim_suket.id) AS total'))
            ->groupBy('sys_month.id', 'sys_month.code')
            ->get();

        $pengajuan = DB::table('sys_month')
            ->leftJoin('sim_suket', function ($join) {
                $user = Auth::user();
                $join->on(DB::raw('MONTH(sim_suket.tgl_surat)'), '=', 'sys_month.id')
                    ->where('sim_suket.status', '=', 'proses')
                    ->where('sim_suket.company_id', '=', $user->company_id)
                    ->where(DB::raw('YEAR (sim_suket.tgl_surat)'), '=', date('Y'));
            })
            ->select(DB::raw('sys_month.id,sys_month.code,COUNT(sim_suket.id) AS total'))
            ->groupBy('sys_month.id', 'sys_month.code')
            ->get();

        $terverifikasi = DB::table('sys_month')
            ->leftJoin('sim_suket', function ($join) {
                $user = Auth::user();
                $join->on(DB::raw('MONTH(sim_suket.tgl_surat)'), '=', 'sys_month.id')
                    ->where('sim_suket.status', '=', 'terverifikasi')
                    ->where('sim_suket.company_id', '=', $user->company_id)
                    ->where(DB::raw('YEAR (sim_suket.tgl_surat)'), '=', date('Y'));
            })
            ->select(DB::raw('sys_month.id,sys_month.code,COUNT(sim_suket.id) AS total'))
            ->groupBy('sys_month.id', 'sys_month.code')
            ->get();

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
                        'backgroundColor' => '#007bff',
                        'borderColor' => '#007bff',
                    ],
                    [
                        'data' => $bbn2,
                        'backgroundColor' => '#ffc107',
                        'borderColor' => '#ffc107',
                    ],
                    [
                        'data' => $bbn3,
                        'backgroundColor' => '#28a745',
                        'borderColor' => '#28a745',
                    ]
                ]
            ]
        ]);
    }

    public function pieajukan()
    {
        $user = Auth::user();
        $dataR1 = DB::table('sim_suket')
            ->select(DB::raw('sim_suket.status,COUNT(sim_suket.id) AS total'))
            ->where('sim_suket.company_id', '=', $user->company_id)
            ->groupBy('sim_suket.status')
            ->get();
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

    public function chartline()
    {
        $user = Auth::user();
        $proses = DB::table('sys_month')
            ->leftJoin('sim_visitors', function ($join) {
                $user = Auth::user();
                $join->on(DB::raw('MONTH(sim_visitors.created_at)'), '=', 'sys_month.id')
                    ->whereYear('sim_visitors.created_at', date('Y'));
            })
            ->select(DB::raw('sys_month.id,sys_month.code,COUNT(sim_visitors.id) AS total'))
            ->groupBy('sys_month.id', 'sys_month.code')
            ->get();

        $pengajuan = DB::table('sys_month')
            ->leftJoin('sim_visitors', function ($join) {
                $user = Auth::user();
                $join->on(DB::raw('MONTH(sim_visitors.created_at)'), '=', 'sys_month.id')
                    ->whereYear('sim_visitors.created_at', date('Y') - 1);
            })
            ->select(DB::raw('sys_month.id,sys_month.code,COUNT(sim_visitors.id) AS total'))
            ->groupBy('sys_month.id', 'sys_month.code')
            ->get();

        $terverifikasi = DB::table('sys_month')
            ->leftJoin('sim_visitors', function ($join) {
                $user = Auth::user();
                $join->on(DB::raw('MONTH(sim_visitors.created_at)'), '=', 'sys_month.id')
                    ->whereYear('sim_visitors.created_at', date('Y') - 2);
            })
            ->select(DB::raw('sys_month.id,sys_month.code,COUNT(sim_visitors.id) AS total'))
            ->groupBy('sys_month.id', 'sys_month.code')
            ->get();

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

    public function notifcount()
    {
        $users = Auth::user();
        $suketPengajuan = 0;
        $suketProses = 0;
        $company = 0;
        $sptOpen = 0;
        $renjaUpt = 0;
        $pengaduan = 0;
        if ($users->role_id == 38) {
            $suketPengajuan = DB::table('sim_suket')
                ->where('status', 'terkirim')
                ->count();
            $company = DB::table('m_company')
                ->where('status', 0)
                ->where('comp_type', 'agent')
                ->count();

            $renjaUpt = DB::table('sim_renja')
                ->join('users', 'users.id', '=', 'sim_renja.created_by')
                ->join('sim_biodata', 'sim_biodata.id', '=', 'users.biodata_id')
                ->where('sim_renja.status', 'approve_upt')
                ->count();
            $pengaduan = DB::table('sim_pengaduan')
                ->where('status', 0)
                ->count();
        } elseif ($users->role_id == 39) {
            $suketProses = DB::table('sim_suket')
                ->where('status', 'proses')
                ->where('biodata_upt_id', $users->biodata_id)
                ->count();
            $upt = DB::table('sim_user_upt')->select('upt_id')->where('biodata_id', $users->biodata_id)->first();
            $renjaUpt = DB::table('sim_renja')
                ->join('users', 'users.id', '=', 'sim_renja.created_by')
                ->join('sim_biodata', 'sim_biodata.id', '=', 'users.biodata_id')
                ->join('sim_user_upt', 'sim_user_upt.biodata_id', '=', 'sim_biodata.id')
                ->where('sim_renja.status', 'terkirim')
                ->where('sim_user_upt.upt_id', $upt->upt_id)
                ->count();
        } elseif ($users->role_id == 34) {
            $sptOpen = DB::table('sim_spt')
                ->join('sim_spt_biodata', 'sim_spt_biodata.spt_id', '=', 'sim_spt.id')
                ->where('sim_spt.status', 'open')
                ->where('sim_spt_biodata.biodata_id', $users->biodata_id)
                ->count();
        }
        return response()->json([
            'success' => true,
            'data' => [
                'pjkkk_proses' => $company,
                'suket_online' => $suketPengajuan,
                'suket_proses' => $suketProses,
                'spt_open' => $sptOpen,
                'renja_upt' => $renjaUpt,
                'pengaduan' => $pengaduan,
                'notif_all' => $company + $suketPengajuan + $suketProses + $sptOpen + $renjaUpt + $pengaduan,
            ]
        ]);
    }
}
