<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller {

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show($slug, Request $request, Group $group) {
        $page = 1;
        $limit = 5;
        if ($request->page) {
            $page = $request->page;
        }
        $offset = $limit * ($page - 1);

        $topics = $group::select(['id', 'name', 'slug', 'icon'])->orderBy('hierarchy', 'asc')->get();
        $topic = $group::select(['id', 'name', 'slug', 'icon'])->where('slug', $slug)->first();
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
                ->where('datasets.id_topic', $topic->id)
                ->where('datasets.status', 1)
                ->offset($offset)
                ->limit($limit);

        if ($request->q) {
            $count = \App\Models\Dataset::where('title', 'like', '%' . $request->q . '%')->where('status', 1)->count();
            $datasets->where('datasets.title', 'like', '%' . $request->q . '%');
        } else {
            $count = \App\Models\Dataset::where('id_topic', $topic->id)->where('status', 1)->count();
        }

        $totalpage = ceil($count / $limit);
        $datax = $datasets->get();

        return view('frontend.group.index', [
            'topics' => $topics,
            'topic' => $topic,
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
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group) {
        //
    }

}
