<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Manual;
use Illuminate\Support\Str;
use Auth;
use File;

/**
 * Description of CompanyController
 *
 * @author heryhandoko
 */
class ManualController extends Controller {

    //put your code here
    public function index() {
        $user = Auth::user();
        return View('manual.index', [
            'users' => $user
        ]);
    }

    public function fetch(Request $request) {
        if ($request->ajax()) {
            $data = Manual::select('*');
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->filter(function ($instance) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $instance->where(function($w) use($request) {
                                        $search = $request->get('search');
                                        $w->orWhere('judul', 'LIKE', "%" . Str::lower($search['value']) . "%");
                                    });
                                }
                            })
                            ->addColumn('action', function($row) {
                                $user = Auth::user();
                                if ($user->role_id === 35 || $user->role_id === 34) {
                                    $btn = '<a href="' . url('/') . '/' . $row->attachment . '" target="_blank" data-toggle="tooltip"  data-original-title="Unduh" class="btn btn-success btn-sm"><i class="fas fa-download"></i> Unduh</a> ';
                                } else {
                                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="action-view btn btn-primary btn-sm"><i class="fas fa-folder"></i> View</a> ';
                                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="action-edit btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a> ';
                                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="action-delete btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>';
                                }
                                return $btn;
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }
    }

    public function edit($id) {
        $Users = Manual::find($id);
        return response()->json($Users);
    }

    public function update(Request $request, Manual $datapost) {
//        ini_set('memory_limit', '12M');
        $validator = \Validator::make($request->all(), [
                    'judul' => ['required', 'string', 'max:255'],
                    'attachment' => ['required', 'mimes:pdf', 'max:12000']
        ]);

        if ($validator->fails()) {
            return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->toArray()
                            ], 422);
        }

        $photo = $request->file('attachment');
        $pdfname = '';
        $pdfpath = '';
        if ($request->hasFile('attachment')) {
            $path = public_path('uploads');
            $_domain = 'manual';
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

        if (!$request->slug) {
            $slug = Str::slug($request->title, '-');
        } else {
            $slug = Str::slug($request->slug, '-');
        }

        $user = Auth::user();
        $slug = Str::slug($request->judul, '-');
        $input = [
            'judul' => $request->judul,
            'status' => $request->status,
            'slug' => $slug,
            'attachment' => $pdfpath,
            'attachment_name' => $pdfname
        ];
        if ($request->id) {
            $input['updated_at'] = date('Y-m-d H:i:s');
            $input['updated_by'] = $user->id;
            Manual::where('id', $request->id)->update($input);
            $status = 'update';
        } else {
            $input['created_at'] = date('Y-m-d H:i:s');
            $input['created_by'] = $user->id;
            $status = 'insert';
            $datapost->storeData($input);
        }
        return response()->json([
                    'success' => true,
                    'message' => $status . ' manual success',
        ]);
    }

    public function destroy($id) {
        Manual::find($id)->delete();
        return response()->json(['success' => true]);
    }

}
