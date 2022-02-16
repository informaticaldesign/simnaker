<?php

namespace App\Http\Controllers;

use App\Models\Pengawasan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use DataTables;
use DB;

class PengawasanController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        return View('pengawasan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
        return View('pengawasan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pengawasan $datapost) {
        //
        $validator = \Validator::make($request->all(), [
                    'perusahaan' => ['required', 'numeric', 'min:1'],
                    'tgl_pemeriksaan' => ['required', 'date_format:Y-m-d'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->toArray()
                            ], 422);
        }

        $user = Auth::user();
        $input = [
            'tgl_pemeriksaan' => $request->tgl_pemeriksaan,
            'perusahaan' => $request->perusahaan,
            'pemeriksa' => $user->id
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
            Pengawasan::where('id', $request->id)->update($input);
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
     * @param  \App\Models\Pengawasan  $pengawasan
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
        $perusahaans = \App\Models\Perusahaan::pluck('name', 'id');
        $data = Pengawasan::select([
                    'pengawasans.id',
                    'pengawasans.tgl_pemeriksaan',
                    'pengawasans.perusahaan',
                    'pengawasans.pemeriksa',
                    'users.name AS nama_pemeriksa',
                    'perusahaans.name AS nama_perusahaan'
                ])
                ->leftJoin('perusahaans', 'perusahaans.id', '=', 'pengawasans.perusahaan')
                ->leftJoin('users', 'users.id', '=', 'pengawasans.pemeriksa')
                ->where('pengawasans.id', '=', $id)
                ->first();
        return View('pengawasan.view', [
            'datastore' => $data,
            'perusahaans' => $perusahaans
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengawasan  $pengawasan
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $perusahaans = \App\Models\Perusahaan::pluck('name', 'id');
        $data = Pengawasan::select([
                    'pengawasans.id',
                    'pengawasans.tgl_pemeriksaan',
                    'pengawasans.perusahaan',
                    'pengawasans.pemeriksa',
                    'users.name AS nama_pemeriksa',
                    'perusahaans.name AS nama_perusahaan'
                ])
                ->leftJoin('perusahaans', 'perusahaans.id', '=', 'pengawasans.perusahaan')
                ->leftJoin('users', 'users.id', '=', 'pengawasans.pemeriksa')
                ->where('pengawasans.id', '=', $id)
                ->first();
        return View('pengawasan.edit', [
            'datastore' => $data,
            'perusahaans' => $perusahaans
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengawasan  $pengawasan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengawasan $pengawasan) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengawasan  $pengawasan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
        Pengawasan::find($id)->delete();
        return response()->json(['success' => true]);
    }

    public function fetch(Request $request) {
        if ($request->ajax()) {
            $data = Pengawasan::select([
                        'pengawasans.id',
                        'pengawasans.tgl_pemeriksaan',
                        'pengawasans.perusahaan',
                        'pengawasans.pemeriksa',
                        'users.name AS nama_pemeriksa',
                        'perusahaans.name AS nama_perusahaan'
                    ])
                    ->leftJoin('perusahaans', 'perusahaans.id', '=', 'pengawasans.perusahaan')
                    ->leftJoin('users', 'users.id', '=', 'pengawasans.pemeriksa');
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->filter(function ($instance) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $instance->where(function ($w) use ($request) {
                                        $search = $request->get('search');
                                        $w->orWhere('users.name', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                        ->orWhere('perusahaans.name', 'LIKE', "%" . Str::lower($search['value']) . "%");
                                    });
                                }
                            })
                            ->addColumn('action', function ($row) {
                                $btn = '<a href="' . url('pengawasan/' . $row->id . '/show/') . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="action-view"><i class="fas fa-eye text-success"></i></a> ';
                                $btn .= '<a href="' . url('pengawasan/' . $row->id . '/edit/') . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="action-edit"><i class="fas fa-pencil-alt text-warning"></i></a> ';
                                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="action-delete"><i class="fas fa-trash text-danger"></i></a>';
                                return $btn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }
    }

}
