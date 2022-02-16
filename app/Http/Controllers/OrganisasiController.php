<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use DataTables;
use Illuminate\Support\Str;

class OrganisasiController extends Controller {

    public $listing_cols = ['id', 'name', 'slug', 'icon', 'hierarchy', 'description'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return View('organisasi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return View('organisasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Organization $organization) {
        //
        date_default_timezone_set("Asia/Bangkok");
        ini_set('memory_limit', '1024M');
        ini_set('upload_max_filesize', '1024M');
        ini_set('post_max_size', '1024M');

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'hierachy' => ['numeric', 'min:1', 'max:100'],
            'icon' => ['required', 'mimes:jpeg,jpg,png,svg', 'max:10000', 'dimensions:min_width=100,min_height=100']
        ]);

        $ext = $request->icon->extension();
        $slug = Str::slug($request->name, '-');
        $imageName = $slug . '.' . $ext;
        $request->icon->move(public_path('uploads/organisasi/'), $imageName);
        $input = [
            'name' => $request->name,
            'slug' => $slug,
            'hierarchy' => $request->hierarchy,
            'created_at' => date('Y-m-d H:i:s'),
            'icon' => $imageName,
            'description' => $request->description,
        ];
        $dataId = $organization->storeData($input);
        if ($dataId) {
            return redirect()->route('admin.organisasi', ['id' => $dataId->id]);
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
            $data = Organization::select($this->listing_cols)->orderBy('hierarchy', 'asc');
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('image', function ($artist) {
                                $url = asset('uploads/organisasi/' . $artist->icon);
                                return '<img src="' . $url . '" border="0" width="40" height="40" class="img-rounded" align="center" />';
                            })
                            ->addColumn('action', function($row) {
                                $btn = '<a href="' . url('admin/organisasi/show/' . $row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="View" class="action-view btn btn-primary btn-sm"><i class="fas fa-folder"></i> View</a> ';
                                $btn .= '<a href="' . url('admin/organisasi/' . $row->id . '/edit/') . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="action-edit btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a> ';
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
        $topic = Organization::select($this->listing_cols)->where('id', $id)->first();
        return View('organisasi.view', [
            'topic' => $topic
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
        $topic = Organization::select($this->listing_cols)->where('id', $id)->first();
        return View('organisasi.update', [
            'topic' => $topic
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
        Organization::where('id', $request->id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'hierarchy' => $request->hierarchy,
            'description' => $request->description,
        ]);
        return View('organisasi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Organization::find($id)->delete();
        return response()->json(['success' => true]);
    }

}
