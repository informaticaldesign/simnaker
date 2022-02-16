<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Auth;
use DataTables;
use DB;

class PemeriksaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return View('pemeriksaan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $perusahaans = \App\Models\Perusahaan::pluck('name', 'id');
        $jnspemeriksaans = \App\Models\Jnspemeriksaan::pluck('name', 'id');
        return View('pemeriksaan.create', [
            'perusahaans' => $perusahaans,
            'jnspemeriksaans' => $jnspemeriksaans
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pemeriksaan $datapost)
    {
        //
        $validator = \Validator::make($request->all(), [
            'no_surat' => ['required', 'string', 'max:255', Rule::unique('pemeriksaans')->ignore($request->id)],
            'perihal' => ['required', 'string', 'max:255'],
            'no_spt' => ['required', 'string', 'max:255'],
            'jml_lampiran' => ['required', 'numeric', 'min:1'],
            'sifat' => ['required', 'numeric', 'min:1'],
            'perusahaan' => ['required', 'numeric', 'min:1'],
            'jns_pemeriksaan' => ['required', 'numeric', 'min:1'],
            'tgl_spt' => ['required', 'date_format:Y-m-d'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->toArray()
            ], 422);
        }

        $user = Auth::user();
        $input = [
            'no_surat' => $request->no_surat,
            'sifat' => $request->sifat,
            'jml_lampiran' => $request->jml_lampiran,
            'perihal' => $request->perihal,
            'no_spt' => $request->no_spt,
            'tgl_spt' => $request->tgl_spt,
            'perusahaan' => $request->perusahaan,
            'jns_pemeriksaan' => $request->jns_pemeriksaan,
        ];
        if (!$request->id) {
            $input['created_at'] = date('Y-m-d H:i:s');
            $input['created_by'] = $user->id;
            $status = 'insert';
            $dataId = $datapost->storeData($input);
        } else {
            $input['updated_at'] = date('Y-m-d H:i:s');
            $input['updated_by'] = $user->id;
            $status = 'update';
            Pemeriksaan::where('id', $request->id)->update($input);
            $input['id'] = $request->id;
            $dataId = $input;
        }

        if ($dataId) {
            return response()->json([
                'success' => true,
                'message' => '',
                'status' => $status,
                'data' => $dataId
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => '',
                'id' => 0
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemeriksaan  $pemeriksaan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $perusahaans = \App\Models\Perusahaan::pluck('name', 'id');
        $jnspemeriksaans = \App\Models\Jnspemeriksaan::pluck('name', 'id');
        $data = Pemeriksaan::select(DB::raw('pemeriksaans.id,pemeriksaans.no_surat,pemeriksaans.no_spt,pemeriksaans.sifat,pemeriksaans.perihal,pemeriksaans.tgl_spt,pemeriksaans.jns_pemeriksaan,pemeriksaans.perusahaan,pemeriksaans.jml_lampiran'))
            ->leftJoin('perusahaans', 'perusahaans.id', '=', 'pemeriksaans.perusahaan')
            ->leftJoin('jenis_pemeriksaan', 'jenis_pemeriksaan.id', '=', 'pemeriksaans.jns_pemeriksaan')
            ->where('pemeriksaans.id', '=', $id)
            ->first();
        return View('pemeriksaan.view', [
            'datastore' => $data,
            'perusahaans' => $perusahaans,
            'jnspemeriksaans' => $jnspemeriksaans
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemeriksaan  $pemeriksaan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $perusahaans = \App\Models\Perusahaan::pluck('name', 'id');
        $jnspemeriksaans = \App\Models\Jnspemeriksaan::pluck('name', 'id');
        $data = Pemeriksaan::select(DB::raw('pemeriksaans.id,pemeriksaans.no_surat,pemeriksaans.no_spt,pemeriksaans.sifat,pemeriksaans.perihal,pemeriksaans.tgl_spt,pemeriksaans.jns_pemeriksaan,pemeriksaans.perusahaan,pemeriksaans.jml_lampiran'))
            ->leftJoin('perusahaans', 'perusahaans.id', '=', 'pemeriksaans.perusahaan')
            ->leftJoin('jenis_pemeriksaan', 'jenis_pemeriksaan.id', '=', 'pemeriksaans.jns_pemeriksaan')
            ->where('pemeriksaans.id', '=', $id)
            ->first();
        return View('pemeriksaan.edit', [
            'datastore' => $data,
            'perusahaans' => $perusahaans,
            'jnspemeriksaans' => $jnspemeriksaans
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pemeriksaan  $pemeriksaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemeriksaan $datapost)
    {
        $validator = \Validator::make($request->all(), [
            'no_surat' => ['required', 'string', 'max:255', Rule::unique('pemeriksaans')->ignore($request->id)],
            'perihal' => ['required', 'string', 'max:255'],
            'no_spt' => ['required', 'string', 'max:255'],
            'jml_lampiran' => ['required', 'numeric', 'min:1'],
            'sifat' => ['required', 'numeric', 'min:1'],
            'perusahaan' => ['required', 'numeric', 'min:1'],
            'jns_pemeriksaan' => ['required', 'numeric', 'min:1'],
            'tgl_spt' => ['required', 'date_format:Y-m-d'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->toArray()
            ], 422);
        }

        $user = Auth::user();
        $input = [
            'no_surat' => $request->no_surat,
            'sifat' => $request->sifat,
            'jml_lampiran' => $request->jml_lampiran,
            'perihal' => $request->perihal,
            'no_spt' => $request->no_spt,
            'tgl_spt' => $request->tgl_spt,
            'perusahaan' => $request->perusahaan,
            'jns_pemeriksaan' => $request->jns_pemeriksaan,
        ];
        if (!$request->id) {
            $input['created_at'] = date('Y-m-d H:i:s');
            $input['created_by'] = $user->id;
            $status = 'insert';
            $dataId = $datapost->storeData($input);
        } else {
            $input['updated_at'] = date('Y-m-d H:i:s');
            $input['updated_by'] = $user->id;
            $status = 'update';
            Pemeriksaan::where('id', $request->id)->update($input);
            $input['id'] = $request->id;
            $dataId = $input;
        }

        if ($dataId) {
            return response()->json([
                'success' => true,
                'message' => '',
                'status' => $status,
                'data' => $dataId
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => '',
                'id' => 0
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemeriksaan  $pemeriksaan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Pemeriksaan::find($id)->delete();
        return response()->json(['success' => true]);
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $data = Pemeriksaan::select([
                'pemeriksaans.id',
                'pemeriksaans.no_surat',
                'pemeriksaans.no_spt',
                'pemeriksaans.tgl_spt',
                'pemeriksaans.jns_pemeriksaan',
                'jenis_pemeriksaan.name AS txt_pemeriksaan',
                'perusahaans.name AS txt_perusahaan',
                'pemeriksaans.perusahaan'
            ])
                ->leftJoin('perusahaans', 'perusahaans.id', '=', 'pemeriksaans.perusahaan')
                ->leftJoin('jenis_pemeriksaan', 'jenis_pemeriksaan.id', '=', 'pemeriksaans.jns_pemeriksaan');
            return DataTables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->orWhere('jenis_pemeriksaan.name', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                ->orWhere('perusahaans.name', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                ->orWhere('pemeriksaans.no_spt', 'LIKE', "%" . Str::lower($search['value']) . "%");
                        });
                    }
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . url('pemeriksaan/' . $row->id . '/show/') . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="action-view"><i class="fas fa-eye text-success"></i></a> ';
                    $btn .= '<a href="' . url('pemeriksaan/' . $row->id . '/edit/') . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="action-edit"><i class="fas fa-pencil-alt text-warning"></i></a> ';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="action-delete"><i class="fas fa-trash text-danger"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
