<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organization;
use DB;

class OrganizationController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $page = 1;
        $limit = 12;
        if ($request->page) {
            $page = $request->page;
        }
        $offset = $limit * ($page - 1);
        $organizations = Organization::select(['id', 'name', 'slug', 'icon', DB::raw('f_total_dataset(id) as count_dataset')])
                ->orderBy('hierarchy', 'asc')
                ->offset($offset)
                ->limit($limit);
        if ($request->q) {
            $count = Organization::where('name', 'like', '%' . $request->q . '%')->count();
            $organizations->where('name', 'like', '%' . $request->q . '%');
        } else {
            $count = Organization::count();
        }
        $totalpage = ceil($count / $limit);
        $datax = $organizations->get();
        return view('frontend.organisasi.index', [
            'organizations' => $datax,
            'page' => $page,
            'total' => $count,
            'totalpage' => $totalpage
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug, Request $request) {
        $page = 1;
        $limit = 5;
        if ($request->page) {
            $page = $request->page;
        }
        $offset = $limit * ($page - 1);
        $organization = \App\Models\Organization::select(['id', 'name', 'slug', 'icon'])->where('slug', $slug)->first();
        $topics = \App\Models\Group::select(['id', 'name', 'slug', 'icon'])->orderBy('hierarchy', 'asc')->get();
        $datasets = $datasets = \App\Models\Dataset::select(['datasets.id',
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
                ->where('organizations.id', $organization->id)
                ->offset($offset)
                ->limit($limit);

        if ($request->q) {
            $count = \App\Models\Dataset::where('title', 'like', '%' . $request->q . '%')->count();
            $datasets->where('datasets.title', 'like', '%' . $request->q . '%');
        } else {
            $count = \App\Models\Dataset::where('id_organization', $organization->id)->count();
        }

        $totalpage = ceil($count / $limit);
        $datax = $datasets->get();

        return view('frontend.organisasi.detail', [
            'topics' => $topics,
            'organization' => $organization,
            'datasets' => $datax,
            'slug' => $slug,
            'page' => $page,
            'total' => $count,
            'totalpage' => $totalpage
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
