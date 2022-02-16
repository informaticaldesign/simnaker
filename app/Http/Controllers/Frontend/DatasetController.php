<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Frontend;

use DB;
use Illuminate\Http\Request;

/**
 * Description of BerandaController
 *
 * @author heryhandoko
 */
class DatasetController {

    //put your code here
    public function index(Request $request) {
        $page = 1;
        $limit = 5;
        if ($request->page) {
            $page = $request->page;
        }
        $offset = $limit * ($page - 1);
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
                ->where('datasets.status', 1)
                ->offset($offset)
                ->limit($limit);

        if ($request->q) {
            $count = \App\Models\Dataset::where('title', 'like', '%' . $request->q . '%')->where('status', 1)->count();
            $datasets->where('title', 'like', '%' . $request->q . '%');
        } else {
            $count = \App\Models\Dataset::where('status', 1)->count();
        }

        $totalpage = ceil($count / $limit);
        $datax = $datasets->get();
        return view('frontend.dataset.index', [
            'topics' => $topics,
            'datasets' => $datax,
            'q' => '',
            'page' => $page,
            'total' => $count,
            'totalpage' => $totalpage
        ]);
    }

    public function show($slug, Request $request) {
        $view = 'chart';
        if ($request->view_id == '4887311f-8757-4500-8a7e-886a6577a269') {
            $view = 'chart';
        } elseif ($request->view_id == '28bf9fb4-65a2-4378-a791-beac78cf789') {
            $view = 'table';
        } elseif ($request->view_id == '192ce991-fcd7-4aa0-9a37-628b9a483bca') {
            $view = 'maps';
        }
        $dataset = \App\Models\Dataset::select(['datasets.id',
                    'datasets.created_at',
                    'datasets.title',
                    'datasets.slug',
                    'datasets.description',
                    'datasets.counter',
                    'datasets.thumbnail',
                    'datasets.api_id',
                    'groups.id AS group_id',
                    'groups.name AS topic_name',
                    'organizations.name AS organizations_name',
                    'organizations.slug AS organizations_slug'
                ])
                ->leftJoin('groups', 'groups.id', '=', 'datasets.id_topic')
                ->leftJoin('organizations', 'organizations.id', '=', 'datasets.id_organization')
                ->where('datasets.slug', $slug)
                ->where('datasets.status', 1)
                ->first();
        $datasets = \App\Models\Dataset::select(['datasets.id',
                    'datasets.created_at',
                    'datasets.title',
                    'datasets.slug',
                    'datasets.description',
                    'datasets.counter',
                    'datasets.thumbnail',
                    'groups.name AS topic_name',
                    'organizations.name AS organizations_name',
                    'organizations.slug AS organizations_slug',
                ])
                ->leftJoin('groups', 'groups.id', '=', 'datasets.id_topic')
                ->leftJoin('organizations', 'organizations.id', '=', 'datasets.id_organization')
                ->where('groups.id', $dataset->group_id)
                ->where('datasets.id', '!=', $dataset->id)
                ->where('datasets.status', 1)
                ->limit(3)
                ->get();
        return view('frontend.dataset.detail', [
            'dataset' => $dataset,
            'datasets' => $datasets,
            'view' => $view
        ]);
    }

    public function ichart($slug) {
        return view('frontend.dataset.iframe.chart', [
            'slug' => $slug
        ]);
    }

    public function itable($slug) {
        return view('frontend.dataset.iframe.table', [
            'slug' => $slug
        ]);
    }

    public function imaps($slug) {
        return view('frontend.dataset.iframe.maps', [
            'slug' => $slug
        ]);
    }

}
