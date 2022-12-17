<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Homepage;
use Illuminate\Support\Str;
use Auth;
use File;

/**
 * Description of CompanyController
 *
 * @author heryhandoko
 */
class HomepageController extends Controller {

    //put your code here
    public function index() {
        $user = Auth::user();
        return View('homepage.index', [
            'users' => $user
        ]);
    }

    public function fetch(Request $request) {
        if ($request->ajax()) {
            $data = Homepage::select('*');
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->filter(function ($instance) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $instance->where(function($w) use($request) {
                                        $search = $request->get('search');
                                        $w->orWhere('title', 'LIKE', "%" . Str::lower($search['value']) . "%");
                                    });
                                }
                            })->addColumn('image', function ($artist) {
                                $url = url($artist->img_path);
                                return '<img src="' . $url . '" border="0" width="100" class="img-rounded" align="center" />';
                            })
                            ->addColumn('action', function($row) {
                                $user = Auth::user();
                                if ($user->role_id === 35 || $user->role_id === 34) {
                                    $btn = '<a href="' . url('/') . '/' . $row->img_path . '" target="_blank" data-toggle="tooltip"  data-original-title="Unduh" class="btn btn-success btn-sm"><i class="fas fa-download"></i> Unduh</a> ';
                                } else {
                                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="action-view btn btn-primary btn-sm"><i class="fas fa-folder"></i> View</a> ';
                                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="action-edit btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a> ';
                                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="action-delete btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>';
                                }
                                return $btn;
                            })
                            ->addColumn('status', function($row) {
                                if ($row->status == 1) {
                                    return '<span class="badge bg-success">Active</span>';
                                } else {
                                    return '<span class="badge bg-danger">Non Active</span>';
                                }
                            })
                            ->rawColumns(['status', 'action', 'image'])
                            ->make(true);
        }
    }

    public function edit($id) {
        $Users = Homepage::find($id);
        return response()->json($Users);
    }

    public function update(Request $request, Homepage $datapost) {
        date_default_timezone_set("Asia/Bangkok");
        ini_set('memory_limit', '1024M');
        ini_set('upload_max_filesize', '1024M');
        ini_set('post_max_size', '1024M');
        $todayDate = date('Y-m-d');

        $valiatdate = [
            'title' => ['required', 'string', 'max:255'],
            'sorting' => ['required'],
            'start_date' => ['required', 'string', 'max:255', 'date_format:Y-m-d', 'after_or_equal:' . $todayDate],
            'end_date' => ['required', 'string', 'max:255', 'date_format:Y-m-d', 'after_or_equal:start_date']
        ];
        if (!$request->id) {
            $valiatdate['img_path'] = ['required', 'mimes:jpg,png,jpeg', 'max:1000', 'dimensions:max_width=1280,max_height=720'];
        }
        $validator = \Validator::make($request->all(), $valiatdate);
        if ($validator->fails()) {
            return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->toArray()
                            ], 422);
        }

        $photo = $request->file('img_path');
        $pdfname = '';
        $pdfpath = '';
        $input = [
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'sorting' => $request->sorting,
        ];
        if ($request->hasFile('img_path')) {
            $path = public_path('uploads');
            $_domain = 'logo';
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
            $pdfname = Str::slug($photo->getClientOriginalName(), '-');
            $extFile = $photo->getClientOriginalExtension();
            $pdfname = $pdfname . '.' . $extFile;
            $pdfpath = 'uploads' . DIRECTORY_SEPARATOR . $_domain . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . $pdfname;
            $photo->move($pathMonth, $pdfname);
            $input['img_path'] = $pdfpath;
        }
        $user = Auth::user();
        $status = 0;
        if ($request->status == 'on' || $request->status == 1) {
            $status = 1;
        }
        $input['status'] = $status;
        if ($request->id) {
            $input['updated_at'] = date('Y-m-d H:i:s');
            $input['updated_by'] = $user->id;
            Homepage::where('id', $request->id)->update($input);
            $status = 'update';
        } else {
            $input['created_at'] = date('Y-m-d H:i:s');
            $input['created_by'] = $user->id;
            $status = 'insert';
            $datapost->storeData($input);
        }
        return response()->json([
                    'success' => true,
                    'message' => $status . ' homepage success',
        ]);
    }

    public function destroy($id) {
        Homepage::find($id)->delete();
        return response()->json(['success' => true]);
    }

}
