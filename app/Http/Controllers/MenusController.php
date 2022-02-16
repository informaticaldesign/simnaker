<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menus;
use App\Models\Modules;

class MenusController extends Controller {

    //
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }

    public function index() {
        $modules = Modules::all();
        $menuItems = Menus::select([
                    'menus.id',
                    'modules.name',
                    'modules.url',
                    'modules.fa_icon AS icon'
                ])->leftJoin('modules', 'modules.id', '=', 'menus.module_id')->where("menus.parent", 0)->orderBy('menus.hierarchy', 'asc')->get();
        return View('menus.index', [
            'menus' => $menuItems,
            'modules' => $modules
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Menus $menus) {
        $name = $request->module_id;
        $type = $request->type;
        $menus->storeData($request->all());
        if ($type == "module") {
            return response()->json([
                        "status" => "success"
                            ], 200);
        } else {
            return redirect('menus');
        }
    }

    public function update(Request $request) {
        $parents = $request->jsonData;
        $parent_id = 0;

        for ($i = 0; $i < count($parents); $i++) {
            $this->apply_hierarchy($parents[$i], $i + 1, $parent_id);
        }

        return $parents;
    }

    function apply_hierarchy($menuItem, $num, $parent_id) {
        $menu = Menus::find($menuItem['id']);
        $menu->parent = $parent_id;
        $menu->hierarchy = $num;
        $menu->save();
        if (isset($menuItem['children'])) {
            for ($i = 0; $i < count($menuItem['children']); $i++) {
                $this->apply_hierarchy($menuItem['children'][$i], $i + 1, $menuItem['id']);
            }
        }
    }

    public function destroy($id) {
        Menus::find($id)->delete();
        return redirect()->route('menus');
    }

}
