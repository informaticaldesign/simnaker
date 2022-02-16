<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configs;

class ConfigsController extends Controller {

    var $skin_array = [
        'White Skin' => 'skin-white',
        'Blue Skin' => 'skin-blue',
        'Black Skin' => 'skin-black',
        'Purple Skin' => 'skin-purple',
        'Yellow Sking' => 'skin-yellow',
        'Red Skin' => 'skin-red',
        'Green Skin' => 'skin-green'
    ];
    var $layout_array = [
        'Fixed Layout' => 'fixed',
        'Boxed Layout' => 'layout-boxed',
        'Top Navigation Layout' => 'layout-top-nav',
        'Sidebar Collapse Layout' => 'sidebar-collapse',
        'Mini Sidebar Layout' => 'sidebar-mini'
    ];
    var $navbar_variants = [
        'Navbar Primary' => 'main-header navbar navbar-expand navbar-dark navbar-primary',
        'Navbar Secondary' => 'main-header navbar navbar-expand navbar-dark navbar-secondary',
        'Navbar Info'=>'main-header navbar navbar-expand navbar-dark navbar-info',
        'Navbar Success'=>'main-header navbar navbar-expand navbar-dark navbar-success',
        'Navbar Danger'=>'main-header navbar navbar-expand navbar-dark navbar-danger',
        'Navbar Indigo'=>'main-header navbar navbar-expand navbar-dark navbar-indigo',
        'Navbar Purple'=>'main-header navbar navbar-expand navbar-dark navbar-purple',
        'Navbar Pink'=>'main-header navbar navbar-expand navbar-dark navbar-pink',
        'Navbar Navy'=>'main-header navbar navbar-expand navbar-dark navbar-navy',
        'Navbar Lightblue'=>'main-header navbar navbar-expand navbar-dark navbar-lightblue',
        'Navbar Gray'=>'main-header navbar navbar-expand navbar-dark navbar-gray',
        'Navbar White'=>'main-header navbar navbar-expand navbar-light navbar-white',
    ];

    //
    public function __construct() {
        $this->middleware('auth');
    }

    //
    public function index() {
        $configs = Configs::getAll();
        return View('configs.index', [
            'configs' => $configs,
            'skins' => $this->skin_array,
            'layouts' => $this->layout_array,
            'variantsnav' => $this->navbar_variants
        ]);
    }

    public function store(Request $request) {
        $all = $request->all();
        foreach (['sidebar_search', 'show_messages', 'show_notifications', 'show_tasks', 'show_rightsidebar'] as $key) {
            if (!isset($all[$key])) {
                $all[$key] = 0;
            } else {
                $all[$key] = 1;
            }
        }
        foreach ($all as $key => $value) {
            Configs::where('key', $key)->update(['value' => $value]);
        }

        return redirect("configs");
    }

}
