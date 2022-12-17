<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Banknota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Banknota\Jenis;
use Illuminate\Support\Str;
use Auth;

/**
 * Description of JenisController
 *
 * @author heryhandoko
 */
class JenisController extends Controller {

    //put your code here
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return View('banknota.jenis.index');
    }

    public function create() {
        return View('banknota.jenis.form');
    }

    public function edit($id) {
        $jenis = Jenis::where('id', $id)->first();
        return View('banknota.jenis.form')->with(compact('jenis'));
    }

    public function fetch(Request $request) {
        if ($request->ajax()) {
            $data = Jenis::select('*');
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
                            ->addColumn('action', function($row) {
                                $btn = '<a href="' . url('banknota/jenis/' . $row->id . '/view') . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="action-view btn btn-primary btn-sm"><i class="fas fa-folder"></i></a> ';
                                $btn .= '<a href="' . url('banknota/jenis/' . $row->id . '/edit') . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="action-edit btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a> ';
                                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="action-delete btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>';
                                return $btn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }
    }

    public function store(Request $request) {
        $validator = \Validator::make($request->all(), [
                    'name' => ['required', 'string'],
                    'status' => ['required', 'string'],
                    'description' => ['required', 'string']
        ]);

        $users = Auth::user();
        if ($validator->fails()) {
            return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->toArray()
                            ], 422);
        }

        $input['name'] = $request->name;
        $input['description'] = $request->description;
        $input['status'] = $request->status;
        if ($request->has('id')) {
            $input['updated_at'] = date('Y-m-d H:i:s');
            $input['updated_by'] = $users->id;
            Jenis::where('id', $request->id)
                    ->update($input);
            return response()->json([
                        'success' => true,
                        'message' => 'Jenis Bank Nota Berhasil update',
            ]);
        } else {
            $input['created_at'] = date('Y-m-d H:i:s');
            $input['created_by'] = $users->id;
            $input['uuid'] = Str::uuid();
            Jenis::create($input);
            return response()->json([
                        'success' => true,
                        'message' => 'Jenis Bank Nota Berhasil dibuat',
            ]);
        }
    }
    
    public function destroy($id) {
        Jenis::find($id)->delete();
        return response()->json(['success' => true]);
    }

}
