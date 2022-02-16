<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Frontend;

/**
 * Description of BerandaController
 *
 * @author heryhandoko
 */
class VisualisasiController {

    //put your code here
    public function index() {
        $visualisasis = \App\Models\Visualisasi::select(['id', 'name', 'slug', 'icon'])->orderBy('created_at', 'desc')->get();
        return view('frontend.visualisasi.index', [
            'visualisasis' => $visualisasis
        ]);
    }

    public function show($slug) {
        //$slug = 'jumlah-pendapatan-asli-daerah-di-banten';
        $visualisasi = \App\Models\Visualisasi::select(['visualisasis.id',
                    'visualisasis.created_at',
                    'visualisasis.name AS title',
                    'visualisasis.slug',
                    'visualisasis.description',
                    'visualisasis.counter',
                    'groups.id AS group_id',
                    'groups.name AS topic_name',
                    'organizations.name AS organizations_name',
                    'organizations.slug AS organizations_slug'
                ])
                ->leftJoin('groups', 'groups.id', '=', 'visualisasis.id_topic')
                ->leftJoin('organizations', 'organizations.id', '=', 'visualisasis.id_organization')
                ->where('visualisasis.slug', $slug)
                ->first();
        $visualisasis = \App\Models\Visualisasi::select(['visualisasis.id',
                    'visualisasis.created_at',
                    'visualisasis.name AS title',
                    'visualisasis.slug',
                    'visualisasis.description',
                    'visualisasis.counter',
                    'groups.name AS topic_name',
                    'organizations.name AS organizations_name',
                    'organizations.slug AS organizations_slug',
                ])
                ->leftJoin('groups', 'groups.id', '=', 'visualisasis.id_topic')
                ->leftJoin('organizations', 'organizations.id', '=', 'visualisasis.id_organization')
                ->where('groups.id', $visualisasi->group_id)
                ->where('visualisasis.id', '!=', $visualisasi->id)
                ->limit(2)
                ->get();
        return view('frontend.visualisasi.detail', [
            'visualisasi' => $visualisasi,
            'visualisasis' => $visualisasis,
        ]);
    }

}
