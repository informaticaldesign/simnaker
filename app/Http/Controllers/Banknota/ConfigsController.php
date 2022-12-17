<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Banknota;

use App\Http\Controllers\Controller;
use App\Models\Banknota\Configs;
use Illuminate\Http\Request;

/**
 * Description of ConfigsController
 *
 * @author heryhandoko
 */
class ConfigsController extends Controller {

    //put your code here
    //put your code here
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $configs = Configs::getAll();
        return View('banknota.configs.form', [
            'configs' => $configs,
        ]);
    }

    public function store(Request $request) {
        $all = $request->all();
        foreach ($all as $key => $value) {
            Configs::where('key', $key)->update(['value' => $value]);
        }
        
        return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil diupdate',
        ]);
    }

}
