<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Biodata;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Validation\Rule;

/**
 * Description of PenggunaController
 *
 * @author heryhandoko
 */
class PenggunaController extends Controller {

    //put your code here
    public function index() {
        return View('pengguna.index');
    }

    public function fetch(Request $request) {
        if ($request->ajax()) {
            $data = Biodata::select([
                        'sim_biodata.*',
                        'm_jabatan.name AS jabatan_name',
                        'm_pangkat.name AS pangkat_name',
                        'm_golongan.name AS golongan_name'
                    ])
                    ->leftJoin('m_jabatan', 'm_jabatan.jabatan_code', '=', 'sim_biodata.jabatan_code')
                    ->leftJoin('m_pangkat', 'm_pangkat.pangkat_code', '=', 'sim_biodata.pangkat_code')
                    ->leftJoin('m_golongan', 'm_golongan.golongan_code', '=', 'sim_biodata.golongan_code');
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->filter(function ($instance) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $instance->where(function($w) use($request) {
                                        $search = $request->get('search');
                                        $w->orWhere('sim_biodata.name', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                        ->orWhere('sim_biodata.email', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                        ->orWhere('sim_biodata.address', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                        ->orWhere('sim_biodata.phone', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                        ->orWhere('sim_biodata.nip', 'LIKE', "%" . Str::lower($search['value']) . "%");
                                    });
                                }
                            })
                            ->addColumn('action', function($row) {
                                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="action-view btn btn-primary btn-sm"><i class="fas fa-folder"></i> View</a> ';
                                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="action-edit btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a> ';
                                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="action-delete btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>';
                                return $btn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }
    }

    public function edit($id) {
        $Users = Biodata::find($id);
        return response()->json($Users);
    }

    public function update(Request $request, Biodata $datapost) {
        $validator = \Validator::make($request->all(), [
                    'email' => ['required', 'string', 'max:255', Rule::unique('biodata')->ignore($request->pengguna_id)],
                    'name' => ['required', 'string', 'max:255'],
                    'address' => ['required', 'string', 'max:255'],
                    'nik' => ['required', 'string', 'max:21', Rule::unique('biodata')->ignore($request->pengguna_id)],
                    'phone' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->toArray()
                            ], 422);
        }

        $user = Auth::user();
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'nik' => $request->nik,
            'phone' => $request->phone
        ];
        if ($request->pengguna_id) {
            $input['updated_at'] = date('Y-m-d H:i:s');
            $input['updated_by'] = $user->id;
            Biodata::where('id', $request->pengguna_id)->update($input);
            $status = 'update';
        } else {
            $input['created_at'] = date('Y-m-d H:i:s');
            $input['created_by'] = $user->id;
            $status = 'insert';
            $datapost->storeData($input);
        }
        return response()->json([
                    'success' => true,
                    'message' => 'Update user success',
        ]);
    }

    public function destroy($id) {
        Biodata::find($id)->delete();
        return response()->json(['success' => true]);
    }

}
