<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dataset;
use DataTables;
use Auth;
use Illuminate\Support\Str;

/**
 * Description of ValidasiController
 *
 * @author heryhandoko
 */
class ValidasiController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return View('validasi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $topiks = \App\Models\Group::pluck('name', 'id');
        $organizations = \App\Models\Organization::pluck('name', 'id');
        return View('dataset.create', [
            'topiks' => $topiks,
            'organizations' => $organizations
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Dataset $dataset) {

        $request->validate([
            'title' => ['required', 'string', 'max:1000'],
        ]);
        $slug = Str::slug($request->title, '-');
        $user = Auth::user();
        $input = [
            'title' => $request->title,
            'id_topic' => $request->id_topic,
            'id_organization' => $request->id_organization,
            'slug' => $slug,
            'created_at' => date('Y-m-d H:i:s'),
            'description' => $request->description,
            'status' => $request->status,
            'counter' => 0,
            'api_id' => $request->api_id,
            'created_by' => $user->id
        ];
        $dataId = $dataset->storeData($input);
        if ($dataId) {
            return redirect()->route('admin.dataset', ['id' => $dataId->id]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fetch(Request $request) {
        if ($request->ajax()) {
            $data = Dataset::select(['datasets.id',
                        'datasets.created_at',
                        'datasets.title',
                        'datasets.slug',
                        'datasets.description',
                        'datasets.counter',
                        'datasets.thumbnail',
                        'datasets.status',
                        'groups.name AS topic_name',
                        'organizations.name AS organizations_name',
                        'organizations.slug AS organizations_slug',
                        'users.name AS created_by'
                    ])
                    ->leftJoin('groups', 'groups.id', '=', 'datasets.id_topic')
                    ->leftJoin('users', 'users.id', '=', 'datasets.created_by')
                    ->leftJoin('organizations', 'organizations.id', '=', 'datasets.id_organization')
                    ->where('datasets.status', '=', 0);
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->filter(function ($instance) use ($request) {
                                if (!empty($request->get('search'))) {
                                    $instance->where(function($w) use($request) {
                                        $search = $request->get('search');
                                        $w->orWhere('datasets.title', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                        ->orWhere('datasets.slug', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                        ->orWhere('groups.name', 'LIKE', "%" . Str::lower($search['value']) . "%")
                                        ->orWhere('organizations.name', 'LIKE', "%" . Str::lower($search['value']) . "%");
                                    });
                                }
                            })
                            ->addColumn('status', function($row) {
                                if ($row->status == 1) {
                                    $btn = '<small class="badge badge-success">Publish</small>';
                                } else {
                                    $btn = '<small class="badge badge-danger">Unpublish</small>';
                                }

                                return $btn;
                            })
                            ->addColumn('action', function($row) {
                                $btn = '<a href="' . url('admin/dataset/show/' . $row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="action-view btn btn-primary btn-sm"><i class="fas fa-folder"></i> View</a> ';
                                $btn .= '<a href="' . url('admin/dataset/' . $row->id . '/edit/') . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="action-edit btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a> ';
                                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="action-delete btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>';
                                return $btn;
                            })
                            ->rawColumns(['status', 'action'])
                            ->orderColumn('status', 'status $1')
                            ->make(true);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
        $dataset = Dataset::select(['datasets.id',
                            'datasets.created_at',
                            'datasets.title',
                            'datasets.slug',
                            'datasets.description',
                            'datasets.counter',
                            'datasets.thumbnail',
                            'groups.name AS topic_name',
                            'organizations.name AS organizations_name',
                            'organizations.slug AS organizations_slug'
                        ])
                        ->leftJoin('groups', 'groups.id', '=', 'datasets.id_topic')
                        ->leftJoin('organizations', 'organizations.id', '=', 'datasets.id_organization')
                        ->where('datasets.id', $id)->first();
        return View('dataset.view', [
            'dataset' => $dataset
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
        $dataset = Dataset::select(['datasets.id',
                            'datasets.created_at',
                            'datasets.title',
                            'datasets.slug',
                            'datasets.api_id',
                            'datasets.description',
                            'datasets.counter',
                            'datasets.thumbnail',
                            'groups.id AS id_topic',
                            'groups.name AS topic_name',
                            'organizations.id AS id_organization',
                            'organizations.name AS organizations_name',
                            'organizations.slug AS organizations_slug'
                        ])
                        ->leftJoin('groups', 'groups.id', '=', 'datasets.id_topic')
                        ->leftJoin('organizations', 'organizations.id', '=', 'datasets.id_organization')
                        ->where('datasets.id', $id)->first();
        $topiks = \App\Models\Group::pluck('name', 'id');
        $organizations = \App\Models\Organization::pluck('name', 'id');
        return View('dataset.update', [
            'dataset' => $dataset,
            'topiks' => $topiks,
            'organizations' => $organizations
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        //
        $user = Auth::user();
        $slug = Str::slug($request->title, '-');
        Dataset::where('id', $request->id)->update([
            'title' => $request->title,
            'slug' => $slug,
            'id_topic' => $request->id_topic,
            'id_organization' => $request->id_organization,
            'description' => $request->description,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $user->id,
            'status' => $request->status,
        ]);
        return View('dataset.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Dataset::find($id)->delete();
        return response()->json(['success' => true]);
    }

}
