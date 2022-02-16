<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visualisasi;
use DataTables;
use Illuminate\Support\Str;
use Auth;

class VisualisasiController extends Controller {

    public $listing_cols = ['id', 'name', 'slug', 'icon', 'description'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return View('visualisasi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $topiks = \App\Models\Group::pluck('name', 'id');
        $organizations = \App\Models\Organization::pluck('name', 'id');
        return View('visualisasi.create', [
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
    public function store(Request $request, Visualisasi $organization) {
        //
        date_default_timezone_set("Asia/Bangkok");
        ini_set('memory_limit', '1024M');
        ini_set('upload_max_filesize', '1024M');
        ini_set('post_max_size', '1024M');

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:4000'],
            'icon' => ['required', 'mimes:jpeg,jpg,png,svg', 'max:10000', 'dimensions:min_width=100,min_height=100']
        ]);


        $image = $request->icon;
        $dirVisual = public_path('uploads/visualisasi/thumbnails');
        $_year = date('Y');
        $_month = date('m');
        $slug = Str::slug($request->name, '-');
        $shortpath = '';
        $imageName = '';
        if ($image !== '') {
            $ext = $image->extension();
            $imageName = $slug . '.' . $ext;
            if (!file_exists($dirVisual . DIRECTORY_SEPARATOR . $_year)) {
                mkdir($dirVisual . DIRECTORY_SEPARATOR . $_year, 0777, true);
            }
            if (!file_exists($dirVisual . DIRECTORY_SEPARATOR . $_year . DIRECTORY_SEPARATOR . $_month)) {
                mkdir($dirVisual . DIRECTORY_SEPARATOR . $_year . DIRECTORY_SEPARATOR . $_month, 0777, true);
            }
            $shortpath = $_year . DIRECTORY_SEPARATOR . $_month;
            $request->icon->move($dirVisual . DIRECTORY_SEPARATOR . $shortpath, $imageName);
        }
        $input = [
            'name' => $request->name,
            'slug' => $slug,
            'id_topic' => $request->id_topic,
            'id_organization' => $request->id_organization,
            'created_at' => date('Y-m-d H:i:s'),
            'icon' => $shortpath . DIRECTORY_SEPARATOR . $imageName,
            'description' => $request->description,
            'created_by' => $user->id
        ];
        $dataId = $organization->storeData($input);
        if ($dataId) {
            return redirect()->route('admin.visualisasi', ['id' => $dataId->id]);
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
            $data = Visualisasi::select(['visualisasis.id',
                        'visualisasis.created_at',
                        'visualisasis.name AS title',
                        'visualisasis.slug',
                        'visualisasis.description',
                        'visualisasis.counter',
                        'visualisasis.icon',
                        'groups.id AS group_id',
                        'groups.name AS topic_name',
                        'organizations.name AS organizations_name',
                        'organizations.slug AS organizations_slug'
                    ])
                    ->leftJoin('groups', 'groups.id', '=', 'visualisasis.id_topic')
                    ->leftJoin('organizations', 'organizations.id', '=', 'visualisasis.id_organization');
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('image', function ($artist) {
                                $url = asset('uploads/visualisasi/thumbnails/' . $artist->icon);
                                return '<img src="' . $url . '" border="0" width="40" height="40" class="img-rounded" align="center" />';
                            })
                            ->addColumn('action', function($row) {
                                $btn = '<a href="' . url('admin/visualisasi/show/' . $row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="action-view btn btn-primary btn-sm"><i class="fas fa-folder"></i> View</a> ';
                                $btn .= '<a href="' . url('admin/visualisasi/' . $row->id . '/edit/') . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="action-edit btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a> ';
                                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="action-delete btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>';
                                return $btn;
                            })
                            ->rawColumns(['image', 'action'])
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
        $topiks = \App\Models\Group::pluck('name', 'id');
        $organizations = \App\Models\Organization::pluck('name', 'id');
        $topic = Visualisasi::select(['visualisasis.id',
                            'visualisasis.created_at',
                            'visualisasis.name AS title',
                            'visualisasis.slug',
                            'visualisasis.description',
                            'visualisasis.counter',
                            'visualisasis.icon',
                            'groups.id AS group_id',
                            'groups.name AS topic_name',
                            'organizations.name AS organizations_name',
                            'organizations.slug AS organizations_slug'
                        ])
                        ->leftJoin('groups', 'groups.id', '=', 'visualisasis.id_topic')
                        ->leftJoin('organizations', 'organizations.id', '=', 'visualisasis.id_organization')
                        ->where('visualisasis.id', $id)->first();
        return View('visualisasi.view', [
            'topic' => $topic,
            'topiks' => $topiks,
            'organizations' => $organizations
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
        $topiks = \App\Models\Group::pluck('name', 'id');
        $organizations = \App\Models\Organization::pluck('name', 'id');
        $topic = Visualisasi::select(['visualisasis.id',
                            'visualisasis.created_at',
                            'visualisasis.name AS title',
                            'visualisasis.slug',
                            'visualisasis.description',
                            'visualisasis.counter',
                            'visualisasis.icon',
                            'groups.id AS group_id',
                            'groups.name AS topic_name',
                            'organizations.name AS organizations_name',
                            'organizations.slug AS organizations_slug'
                        ])
                        ->leftJoin('groups', 'groups.id', '=', 'visualisasis.id_topic')
                        ->leftJoin('organizations', 'organizations.id', '=', 'visualisasis.id_organization')
                        ->where('visualisasis.id', $id)->first();
        return View('visualisasi.update', [
            'topic' => $topic,
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
        $slug = Str::slug($request->name, '-');
        Visualisasi::where('id', $request->id)->update([
            'name' => $request->name,
            'slug' => $slug,
            'id_topic' => $request->id_topic,
            'id_organization' => $request->id_organization,
            'description' => $request->description,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $user->id
        ]);
        return View('visualisasi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Visualisasi::find($id)->delete();
        return response()->json(['success' => true]);
    }

}
