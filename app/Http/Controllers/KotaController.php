<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Kota;
use Illuminate\Support\Str;
use Auth;

/**
 * Description of KotaController
 *
 * @author heryhandoko
 */
class KotaController extends Controller {

    //put your code here
    public function index() {
        $provinsis = \App\Models\Provinsi::pluck('name', 'prov_code AS id');
        return View('kota.index', [
            'provinsis' => $provinsis,
        ]);
    }

    public function fetch(Request $request) {
        if ($request->ajax()) {
            $data = Kota::select(['m_kota.*', 'm_provinsi.name AS prov_name'])->leftJoin('m_provinsi', 'm_provinsi.prov_code', '=', 'm_kota.prov_code');
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->filter(function ($instance) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $instance->where(function($w) use($request) {
                                        $search = $request->get('search');
                                        $w->orWhere('m_kota.name', 'LIKE', "%" . Str::lower($search['value']) . "%");
                                        $w->orWhere('m_provinsi.name', 'LIKE', "%" . Str::lower($search['value']) . "%");
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
        $Users = Kota::find($id);
        return response()->json($Users);
    }

    public function update(Request $request, Kota $datapost) {
        $validator = \Validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:255'],
                    'prov_code' => ['required', 'string', 'exists:m_provinsi,prov_code'],
                    'city_code' => ['required', 'string', 'max:18', 'unique:m_kota,city_code,' . $request->id],
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
            'city_code' => $request->city_code,
            'prov_code' => $request->prov_code,
        ];
        if ($request->id) {
            $input['updated_at'] = date('Y-m-d H:i:s');
            $input['updated_by'] = $user->id;
            Kota::where('id', $request->id)->update($input);
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
        Kota::find($id)->delete();
        return response()->json(['success' => true]);
    }

    public function combo($code) {
        $cities = \App\Models\Kota::where('prov_code', $code)
                ->pluck('name', 'city_code');
        return response()->json($cities);
    }

}
