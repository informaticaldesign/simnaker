<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
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
        $topics = \App\Models\Group::select(['id', 'name', 'slug', 'icon'])->orderBy('hierarchy', 'asc')->get();
        $datasets = \App\Models\Dataset::select(['datasets.id',
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
                ->whereRaw('LOWER(datasets.description) LIKE ? ', ['%' . trim(strtolower($request->q)) . '%'])
                ->where('datasets.status', 1)
                ->get();
        return view('frontend.search.index', [
            'topics' => $topics,
            'datasets' => $datasets,
            'q' => $request->q
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
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
