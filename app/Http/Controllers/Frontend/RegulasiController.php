<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Regulasi;

/**
 * Description of BerandaController
 *
 * @author heryhandoko
 */
class RegulasiController {

    //put your code here
    public function index(Request $request) {
        $page = 1;
        $limit = 4;
        if ($request->page) {
            $page = $request->page;
        }
        $offset = $limit * ($page - 1);
        $regulasi = Regulasi::select(['*'])
                ->offset($offset)
                ->limit($limit);
        if ($request->keyword) {
            $count = Regulasi::where('judul', 'like', '%' . $request->keyword . '%')->count();
            $regulasi->where('judul', 'like', '%' . $request->keyword . '%');
        } else {
            $count = Regulasi::count();
        }

        $totalpage = ceil($count / $limit);
        $datax = $regulasi->get();
        $tahun = Regulasi::groupBy('tahun')->pluck('tahun');
        $bentuk = Regulasi::groupBy('jenis')->pluck('jenis');
        return view('frontend.regulasi.index', [
            'data' => $datax,
            'q' => '',
            'page' => $page,
            'total' => $count,
            'totalpage' => $totalpage,
            'tahun' => $tahun,
            'bentuk' => $bentuk
        ]);
    }

    public function show($slug, Request $request) {
        $regulasi = Regulasi::select(['*'])
                ->where('slug', $slug)
                ->first();
        $input['view'] = $regulasi->view + 1;
        Regulasi::where('slug', $slug)->update($input);
        return view('frontend.regulasi.detail', [
            'regulasi' => $regulasi
        ]);
    }

}
