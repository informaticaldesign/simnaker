<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Http\Controllers\Frontend;

use App\Models\Company;
use App\Models\Visitors;
/**
 * Description of AksesController
 *
 * @author heryhandoko
 */
class AksesController {
    //put your code here
    //put your code here
    public function index() {
        $visitor = new Visitors();
        $visitor->created_at = date('Y-m-d H:i:s');
        $visitor->save();
        $topic = \App\Models\Group::select(['name', 'slug', 'icon'])->orderBy('hierarchy', 'asc')->get();
        $datasets = \App\Models\Dataset::select(['title', 'slug', 'api_id', 'home_view', 'chart_type'])->where('home_view', '>', 0)->orderBy('home_view', 'asc')->get();
        return view('frontend.akses', [
            'topics' => $topic,
            'datasets' => $datasets
        ]);
    }

    public function fetch() {
        $companys = Company::select(['longitude', 'latitude', 'name', 'logo_path', 'address', 'phone', 'email'])
                ->whereNotNull('longitude')
                ->whereNotNull('latitude')
                ->where('comp_type', 'company')
                ->offset(0)
                ->limit(2000)
                ->get()
                ->toArray();
        return response()->json([
                    'success' => true,
                    'count' => 1,
                    'photos' => $companys
        ]);
    }
}
