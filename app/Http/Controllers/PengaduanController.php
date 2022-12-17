<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DataTables;
use DB;

class PengaduanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index()
    {
        return view('pengaduan.index');
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $data = Pengaduan::select([
                'a.id',
                'a.jenis',
                'a.name',
                'a.email',
                'a.phone',
                'a.kategori',
                'b.name AS lokasi',
                'a.judul',
                'a.laporan',
                'a.status',
                DB::raw('DATE_FORMAT(a.created_at,"%d %b %Y") AS tgl_pengaduan'),
                'a.slug',
                'a.lampiran',
                'a.lampiran_path'
            ])
                ->from('sim_pengaduan AS a')
                ->leftJoin('m_kota AS b', 'b.city_code', '=', 'a.lokasi');
            return DataTables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->orWhere('a.jenis', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                ->orWhere('a.email', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                ->orWhere('a.name', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                ->orWhere('b.name', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                ->orWhere('a.kategori', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                ->orWhere('a.judul', 'LIKE', "%" . Str::lower($search['value']) . "%");
                        });
                    }
                })
                ->addColumn('status', function ($row) {
                    $btn = '';
                    if ($row->status == 0) {
                        $btn = '<small class="badge badge-info">Open</small>';
                    } elseif ($row->status == 1) {
                        $btn = '<small class="badge badge-warning">Proses</small>';
                    } else {
                        $btn = '<small class="badge badge-success">Close</small>';
                    }
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . url('admin/layanan-pengaduan/' . $row->id) . '/edit" data-toggle="tooltip"  data-original-title="Edit" class="action-edit btn btn-sm btn-success mr-1"><i class="fas fa-pencil-alt"></i></a> ';
                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->orderColumn('no_surat', 'no_surat $1')
                ->make(true);
        }
    }

    public function edit($id)
    {
        # code...
        $pengaduan = Pengaduan::find($id);
        $kotas = \App\Models\Kota::pluck('name', 'city_code AS id');
        $kategori = [
            'kecelakaan_kerja' => 'Kecelakaan Kerja',
            'tenaga_kerja_asing' => 'Tenaga Kerja Asing',
            'percaloan_tenaga_kerja' => 'Percaloan Tenaga Kerja',
            'bpjs_ketenagakerjaan' => 'BPJS Ketenagakerjaan',
            'pekerja_migran_indonesia' => 'Pekerja Migran Indonesia',
            'pungutan_liar' => 'Pungutan Liar',
        ];
        return view('pengaduan.edit', [
            'pengaduan' => $pengaduan,
            'kotas' => $kotas,
            'categories' => $kategori
        ]);
    }
    public function store(Request $request)
    {
        # code...
        Pengaduan::where('id', $request->id)->update(['status' => $request->status, 'updated_at' => date('Y-m-d H:i:s')]);
        return redirect('/admin/layanan-pengaduan');
    }
}
