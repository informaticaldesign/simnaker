<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Pemberitahuan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

/**
 * Description of TemplateController
 *
 * @author heryhandoko
 */
class TemplateController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $template = DB::table('m_templates')->where('id', 2)->first();
        return View('pemberitahuan.template.index', [
            'template' => $template
        ]);
    }

    public function store(Request $request) {
        if ($request->flag == 'simpan') {
            if ($request->id) {
                DB::table('m_templates')
                        ->where('id', $request->id)
                        ->update(['content' => $request->content]);
            } else {
                DB::table('m_templates')->insert([
                    'content' => $request->content
                ]);
            }
            return response()->json([
                        'success' => true,
                        'message' => 'Pendaftaran PJK3 Berhasil',
            ]);
        } else {
            return response()->json([
                        'success' => false,
            ]);
        }
    }

}
