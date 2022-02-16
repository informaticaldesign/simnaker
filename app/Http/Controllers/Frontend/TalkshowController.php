<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Talkshow;

/**
 * Description of BerandaController
 *
 * @author heryhandoko
 */
class TalkshowController {

    //put your code here
    public function index(Request $request) {
        $page = 1;
        $limit = 5;
        if ($request->page) {
            $page = $request->page;
        }
        $offset = $limit * ($page - 1);
        $regulasi = Talkshow::select(['sim_talkshow.*', 'users.name AS publisher'])
                ->leftJoin('users', 'users.id', '=', 'sim_talkshow.created_by')
                ->offset($offset)
                ->limit($limit);
        if ($request->keyword) {
            $count = Talkshow::where('sim_talkshow.title', 'like', '%' . $request->keyword . '%')->count();
            $regulasi->where('sim_talkshow.title', 'like', '%' . $request->keyword . '%');
        } else {
            $count = Talkshow::count();
        }

        $totalpage = ceil($count / $limit);
        $datax = $regulasi->get();

        $thumbnail = Talkshow::select(['sim_talkshow.*', 'users.name AS publisher'])
                ->leftJoin('users', 'users.id', '=', 'sim_talkshow.created_by')
                ->orderBy('sim_talkshow.created_by', 'DESC')
                ->first();
        return view('frontend.talkshow.index', [
            'thumbnail' => $thumbnail,
            'data' => $datax,
            'q' => '',
            'page' => $page,
            'total' => $count,
            'totalpage' => $totalpage,
        ]);
    }

    public function show($slug, Request $request) {
        $page = 1;
        $limit = 5;
        if ($request->page) {
            $page = $request->page;
        }
        $offset = $limit * ($page - 1);
        $regulasi = Talkshow::select(['sim_talkshow.*', 'users.name AS publisher'])
                ->leftJoin('users', 'users.id', '=', 'sim_talkshow.created_by')
                ->offset($offset)
                ->limit($limit);
        if ($request->keyword) {
            $count = Talkshow::where('sim_talkshow.title', 'like', '%' . $request->keyword . '%')->count();
            $regulasi->where('sim_talkshow.title', 'like', '%' . $request->keyword . '%');
        } else {
            $count = Talkshow::count();
        }

        $totalpage = ceil($count / $limit);
        $datax = $regulasi->get();

        $thumbnail = Talkshow::select(['sim_talkshow.*', 'users.name AS publisher'])
                ->leftJoin('users', 'users.id', '=', 'sim_talkshow.created_by')
                ->where('sim_talkshow.slug', $slug)
                ->first();

        $input['view'] = $thumbnail->view + 1;
        Talkshow::where('slug', $slug)->update($input);
        return view('frontend.talkshow.detail', [
            'thumbnail' => $thumbnail,
            'data' => $datax,
            'q' => '',
            'page' => $page,
            'total' => $count,
            'totalpage' => $totalpage,
        ]);
    }

}
