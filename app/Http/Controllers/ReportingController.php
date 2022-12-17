<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

/**
 * Description of ReportingController
 *
 * @author heryhandoko
 */
class ReportingController extends Controller {

    //put your code here
    public function index() {
        $users = \App\Models\User::select(['id', 'name'])
                ->get()
                ->pluck('name', 'id');
        return view('reporting.index', [
            'users' => $users
        ]);
    }

    public function fetch() {
        $result = DB::table('sim_reporting_line')
                ->leftJoin('users', 'users.id', '=', 'sim_reporting_line.user_id')
                ->where('parent_id', 0)
                ->get(['sim_reporting_line.id', 'sim_reporting_line.user_id', 'users.name']);
        $data = [];
        foreach ($result as $key => $value) {
            $data[] = static::children($value);
        }
        return response()->json($data);
    }

    public static function children($params) {
        $result = DB::table('sim_reporting_line')
                ->leftJoin('users', 'users.id', '=', 'sim_reporting_line.user_id')
                ->where('parent_id', $params->id)
                ->get(['sim_reporting_line.id', 'sim_reporting_line.user_id', 'users.name']);
        $child = [];
        if (count($result) > 0) {
            foreach ($result as $key => $value) {
                $child[] = static::children($value);
            }
        }
        $icon = count($child) > 0 ? 'fa fa-users' : 'fa fa-user';
        $parent = [
            'id' => $params->id,
            'user_id' => $params->user_id,
            'text' => $params->name,
            'icon' => $icon,
            'state' => [
                'opened' => true,
                'disabled' => false,
                'selected' => false
            ],
            'children' => $child
        ];
        return $parent;
    }

    public function destroy($id) {
        DB::table('sim_reporting_line')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }

    public function store(Request $request) {
        $validator = \Validator::make($request->all(), [
                    'user_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                        'success' => false,
                        'message' => $validator->errors()->toArray()
                            ], 422);
        }
        if ($request->parent_id == '#') {
            $request->parent_id = 0;
        }
        DB::table('sim_reporting_line')->insert([
            'user_id' => $request->user_id,
            'parent_id' => $request->parent_id,
            'sort_no' => 1
        ]);
        return response()->json([
                    'success' => true,
                    'node' => [],
                    'message' => 'Buat Rencana Kerja Gagal'
        ]);
    }

}
