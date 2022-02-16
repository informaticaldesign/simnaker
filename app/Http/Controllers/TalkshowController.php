<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Talkshow;
use Illuminate\Support\Str;
use Auth;
use File;

/**
 * Description of CompanyController
 *
 * @author heryhandoko
 */
class TalkshowController extends Controller {

    //put your code here
    public function index() {
        return View('talkshow.index');
    }

    public function fetch(Request $request) {
        if ($request->ajax()) {
            $data = Talkshow::select('*');
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->filter(function ($instance) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $instance->where(function($w) use($request) {
                                        $search = $request->get('search');
                                        $w->orWhere('title', 'LIKE', "%" . Str::lower($search['value']) . "%");
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
        $Users = Talkshow::find($id);
        return response()->json($Users);
    }

    public function update(Request $request, Talkshow $datapost) {
        $validator = \Validator::make($request->all(), [
                    'title' => ['required', 'string', 'max:255'],
                    'url' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->toArray()
                            ], 422);
        }

        if (!$request->slug) {
            $slug = Str::slug($request->title, '-');
        } else {
            $slug = Str::slug($request->slug, '-');
        }

        $user = Auth::user();
        $slug = Str::slug($request->title, '-');
        $input = [
            'title' => $request->title,
            'url' => $request->url,
            'slug' => $slug,
        ];
        if ($request->id) {
            $input['updated_at'] = date('Y-m-d H:i:s');
            $input['updated_by'] = $user->id;
            Talkshow::where('id', $request->id)->update($input);
            $status = 'update';
        } else {
            $input['created_at'] = date('Y-m-d H:i:s');
            $input['created_by'] = $user->id;
            $input['view'] = 0;
            $status = 'insert';
            $datapost->storeData($input);
        }
        return response()->json([
                    'success' => true,
                    'message' => $status . ' regulasi success',
        ]);
    }

    public function destroy($id) {
        Talkshow::find($id)->delete();
        return response()->json(['success' => true]);
    }

}
