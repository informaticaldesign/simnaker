<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Kelurahan;
use Illuminate\Support\Str;
use Auth;

/**
 * Description of KelurahanController
 *
 * @author heryhandoko
 */
class KelurahanController extends Controller {

    //put your code here
    public function index() {
        $provinsis = \App\Models\Provinsi::pluck('name', 'prov_code AS id');
        return View('kelurahan.index', [
            'provinsis' => $provinsis,
        ]);
    }

    public function fetch(Request $request) {
        if ($request->ajax()) {
            $data = Kelurahan::select(['m_kelurahan.*', 'm_provinsi.name AS prov_name', 'm_kota.name AS city_name', 'm_kecamatan.name AS kec_name'])
                    ->leftJoin('m_kecamatan', 'm_kecamatan.kec_code', '=', 'm_kelurahan.kec_code')
                    ->leftJoin('m_kota', 'm_kota.city_code', '=', 'm_kecamatan.city_code')
                    ->leftJoin('m_provinsi', 'm_kota.prov_code', '=', 'm_provinsi.prov_code');
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->filter(function ($instance) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $instance->where(function($w) use($request) {
                                        $search = $request->get('search');
                                        $w->orWhere('m_kelurahan.name', 'LIKE', "%" . Str::lower($search['value']) . "%");
                                        $w->orWhere('m_kota.name', 'LIKE', "%" . Str::lower($search['value']) . "%");
                                        $w->orWhere('m_kecamatan.name', 'LIKE', "%" . Str::lower($search['value']) . "%");
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
        $Users = Kelurahan::select(['m_kelurahan.*', 'm_provinsi.prov_code', 'm_kota.city_code', 'm_kecamatan.kec_code'])
                        ->leftJoin('m_kecamatan', 'm_kecamatan.kec_code', '=', 'm_kelurahan.kec_code')
                        ->leftJoin('m_kota', 'm_kota.city_code', '=', 'm_kecamatan.city_code')
                        ->leftJoin('m_provinsi', 'm_kota.prov_code', '=', 'm_provinsi.prov_code')
                        ->where('m_kelurahan.id', $id)->first();
        return response()->json($Users);
    }

    public function update(Request $request, Kelurahan $datapost) {
        $validator = \Validator::make($request->all(), [
                    'name' => ['required', 'string', 'max:255'],
                    'prov_code' => ['required', 'string', 'exists:m_provinsi,prov_code'],
                    'city_code' => ['required', 'string', 'exists:m_kota,city_code'],
                    'kec_code' => ['required', 'string', 'exists:m_kecamatan,kec_code'],
                    'kel_code' => ['required', 'string', 'max:18', 'unique:m_kelurahan,kel_code,' . $request->id],
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
            'kel_code' => $request->kel_code,
            'kec_code' => $request->kec_code,
        ];
        if ($request->id) {
            $input['updated_at'] = date('Y-m-d H:i:s');
            Kelurahan::where('id', $request->id)->update($input);
            $status = 'update';
        } else {
            $input['created_at'] = date('Y-m-d H:i:s');
            $status = 'insert';
            $datapost->storeData($input);
        }
        return response()->json([
                    'success' => true,
                    'message' => 'Update user success',
        ]);
    }

    public function destroy($id) {
        Kelurahan::find($id)->delete();
        return response()->json(['success' => true]);
    }

    public function combo($code) {
        $cities = \App\Models\Kelurahan::where('kec_code', $code)
                ->pluck('name', 'kel_code');
        return response()->json($cities);
    }

}
