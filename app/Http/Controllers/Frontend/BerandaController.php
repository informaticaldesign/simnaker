<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Frontend;

use App\Models\Company;
use App\Models\Visitors;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
/**
 * Description of BerandaController
 *
 * @author heryhandoko
 */
class BerandaController {

    //put your code here
    public function index() {
        $visitor = new Visitors();
        $visitor->created_at = date('Y-m-d H:i:s');
        $visitor->save();
        $slider = \App\Models\Homepage::where('status', 1)
                ->where('start_date', '<=', Carbon::now())
                ->where('end_date', '>=', Carbon::now())
                ->orderBy('sorting', 'ASC')
                ->orderBy('id', 'DESC')
                ->get();
        return view('frontend.home', [
            'slider' => $slider
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
