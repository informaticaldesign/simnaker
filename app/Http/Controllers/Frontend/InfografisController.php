<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Frontend;

use DB;
use App\Models\Infografik;

/**
 * Description of BerandaController
 *
 * @author heryhandoko
 */
class InfografisController {

    //put your code here
    public function index() {
        $infografis = Infografik::select(['infografiks.id',
                    'infografiks.created_at',
                    'infografiks.name AS title',
                    'infografiks.slug',
                    'infografiks.description',
                    'infografiks.counter',
                    'infografiks.icon AS thumbnail',
                    'groups.name AS topic_name',
                    'organizations.name AS organizations_name',
                    'organizations.slug AS organizations_slug'
                ])
                ->leftJoin('groups', 'groups.id', '=', 'infografiks.id_topic')
                ->leftJoin('organizations', 'organizations.id', '=', 'infografiks.id_organization')
                //->where('infografiks.id',0)
                ->orderBy('created_at', 'desc')
                ->get();
        //$infografis = Infografik::select(['id', 'name', 'slug', 'icon', 'counter'])->orderBy('created_at', 'desc')->get();
        return view('frontend.infografis.index', [
            'infografis' => $infografis
        ]);
    }

    public function show($slug) {
        $counter = Infografik::where('infografiks.slug', $slug)->max('counter');
        Infografik::where('infografiks.slug', $slug)->update(['counter' => $counter + 1]);
        $infografik = Infografik::select(['infografiks.id',
                    'infografiks.created_at',
                    'infografiks.name AS title',
                    'infografiks.slug',
                    'infografiks.description',
                    'infografiks.counter',
                    'infografiks.icon AS thumbnail',
                    'groups.name AS topic_name',
                    'organizations.name AS organizations_name',
                    'organizations.slug AS organizations_slug'
                ])
                ->leftJoin('groups', 'groups.id', '=', 'infografiks.id_topic')
                ->leftJoin('organizations', 'organizations.id', '=', 'infografiks.id_organization')
                ->where('infografiks.slug', $slug)
                ->first();
        $details = DB::table('infografiks_detail')->where('id_infografis', $infografik->id)->get();
        return view('frontend.infografis.detail', [
            'infografik' => $infografik,
            'details' => $details
        ]);
    }

}
