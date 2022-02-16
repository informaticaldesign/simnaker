<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Suket;
use DataTables;
use Auth;
use File;

/**
 * Description of PengajuanController
 *
 * @author heryhandoko
 */
class PengajuanController {

    //put your code here
    public function index() {
        return View('pjk3.pengajuan.index');
    }

    public function create($step, $id) {
        $data = [];
        if ($id != '0') {
            $data = Suket::select(['*'])->where('id', Crypt::decrypt($id))->first();
        }
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
            return View('pjk3.pengajuan.createxx', [
                'step' => $step,
                'id' => $id,
                'data' => $data
            ]);
        } elseif ($step == 4) {
            return View('pjk3.pengajuan.createxxx', [
                'step' => $step,
                'id' => $id,
                'data' => $data
            ]);
        } else {
            $pemeriksaan = \App\Models\Jenispem::pluck('name', 'id');
            $types = \App\Models\Typepem::pluck('name', 'id');
            return View('pjk3.pengajuan.createxxxx', [
                'step' => $step,
                'id' => $id,
                'data' => $data,
                'pemeriksaan' => $pemeriksaan,
                'types' => $types
            ]);
        }
    }

    public function store(Request $request, Suket $suket) {
        $next = $request->step;
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
                $users = Auth::user();
                $input = [
                    'no_surat' => $request->no_surat,
                    'company_id' => $users->company_id,
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
            if ($result) {
                return response()->json([
                            'success' => true,
                            'data' => [
                                'next' => $next + 1,
                                'id' => $request->id
                ]]);
            }
        } elseif ($next == 5) {
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
                'status' => 'proses',
                'step' => $next
            ]);
            if ($result) {
                return response()->json([
                            'success' => true,
                            'data' => [
                                'next' => 0,
                                'id' => 0
                ]]);
            }
        }
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
                    ->leftJoin('m_pemeriksaan AS c', 'c.id', '=', 'a.id_pemeriksaan')
                    ->where('a.company_id', $users->company_id);

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
                            ->addColumn('status', function($row) {
                                if ($row->status == 'draft') {
                                    $btn = '<small class="badge badge-info">Konsep</small>';
                                } elseif ($row->status == 'proses') {
                                    $btn = '<small class="badge badge-warning">Proses</small>';
                                } else {
                                    $btn = '<small class="badge badge-success">Terverifikasi</small>';
                                }
                                return $btn;
                            })
                            ->addColumn('action', function($row) {
                                $id = Crypt::encrypt($row->id);
                                if ($row->status == 'draft') {
                                    $btn = '<a href="' . url('admin/pengajuan/create/1/' . $id) . '" data-toggle="tooltip"  data-id="' . $id . '" data-original-title="Edit" class="action-edit mr-1"><i class="fas fa-pencil-alt text-warning"></i></a> ';
                                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $id . '" data-original-title="Delete" class="action-delete"><i class="fas fa-trash text-danger"></i></a>';
                                } else {
                                    $btn = '<i class="fas fa-pencil-alt text-secondary disabled mr-2"></i>';
                                    $btn .= '<i class="fas fa-trash text-secondary disabled"></i>';
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
