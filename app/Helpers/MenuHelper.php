<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//use DB;

/**
 * Description of MenuHelper
 *
 * @author heryhandoko
 */
class MenuHelper {

    //put your code here
    public static function print_menu_editor($menu) {
        $editing = \Collective\Html\FormFacade::open(['route' => ['menus.destroy', $menu->id], 'method' => 'DELETE', 'style' => 'display:inline']);
        $editing .= '<button class="btn btn-xs btn-danger pull-right btn-menu-remove"><i class="fa fa-times"></i></button>';
        $editing .= \Collective\Html\FormFacade::close();
        if ($menu->type != "module") {
            $info = (object) array();
            $info->id = $menu->id;
            $info->name = $menu->name;
            $info->url = $menu->url;
            $info->type = $menu->type;
            $info->icon = $menu->icon;

            //$editing .= '<a class="editMenuBtn btn btn-xs btn-success pull-right" info=\'' . json_encode($info) . '\'><i class="fa fa-edit"></i></a>';
        }
        $str = '<li class="dd-item dd3-item" data-id="' . $menu->id . '">
			<div class="dd-handle dd3-handle"></div>
			<div class="dd3-content"><i class="fa ' . $menu->icon . '"></i> ' . $menu->name . ' ' . $editing . '</div>';
        $childrens = \App\Models\Menus::select([
                    'menus.id',
                    'modules.name',
                    'modules.url',
                    'modules.fa_icon AS icon'
                ])->leftJoin('modules', 'modules.id', '=', 'menus.module_id')->where("menus.parent", $menu->id)->orderBy('menus.hierarchy', 'asc')->get();

        if (count($childrens) > 0) {
            $str .= '<ol class="dd-list">';
            foreach ($childrens as $children) {
                $str .= MenuHelper::print_menu_editor($children);
            }
            $str .= '</ol>';
        }
        $str .= '</li>';
        return $str;
    }

    public static function print_form($flag, $sektoralId, $idUrusan, $menu, $rowNo, $space) {
        $editing = \Collective\Html\FormFacade::open(['route' => ['menus.destroy', $menu->id], 'method' => 'DELETE', 'style' => 'display:inline']);
        $editing .= \Collective\Html\FormFacade::close();
        $rowNo .= ($rowNo == '') ? $menu->hierarchy : '.' . $menu->hierarchy;
        if ($menu->type != "module") {
            $info = (object) array();
            $info->id = $menu->id;
            $info->name = $menu->name;
            $info->url = $menu->url;
            $info->type = $menu->type;
        }
        $satuan = ($menu->satuan) ? $menu->satuan : '';
        $str = '<tr><td>' . $space . $rowNo . '. ' . $menu->uraian . '</td>';
        $childrens = \App\Models\Forminput::select([
                            'id',
                            'uraian',
                            'satuan',
                            'parent',
                            'hierarchy'
                        ])
                        ->where("parent", $menu->id)
                        ->where("suburusan_id", $idUrusan)
                        ->orderBy('hierarchy', 'asc')->get();
        if (count($childrens) == 0) {
            $str .= '<td>' . $satuan . '</td>';
            $dataSektoral = DB::table('sektorals_detail')->where('komponen_id', $menu->id)->where('sektoral_id', $sektoralId)->first();
            if ($flag == 'view') {
                if ($dataSektoral) {
                    $str .= '<td style="text-align:right;">' . $dataSektoral->qty . '</td>';
                } else {
                    $str .= '<td></td>';
                }
            } else {
                if ($dataSektoral) {
                    $str .= '<td><input type="text" name="qty[' . $menu->id . ']" class="form-control" value="' . $dataSektoral->qty . '"></td>';
                } else {
                    $str .= '<td><input type="text" name="qty[' . $menu->id . ']" class="form-control" value=""></td>';
                }
            }
        } else {
            $str .= '<td></td>';
            $str .= '<td></td>';
        }
        if (count($childrens) > 0) {
            $space .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            foreach ($childrens as $children) {
                $str .= MenuHelper::print_form($flag, $sektoralId, $idUrusan, $children, $rowNo, $space);
            }
        } else {
            
        }
        $str .= '</tr>';
        return $str;
    }

    public static function print_form_report($stryear, $endyear, $menu, $rowNo = '', $space = '') {
        $rowNo .= ($rowNo == '') ? $menu->hierarchy : '.' . $menu->hierarchy;
        if ($menu->type != "module") {
            $info = (object) array();
            $info->id = $menu->id;
            $info->name = $menu->name;
            $info->url = $menu->url;
            $info->type = $menu->type;
        }
        $satuan = ($menu->satuan) ? $menu->satuan : '';
        $str = '<tr>';
        $str .= '<td>' . $space . $rowNo . '. ' . $menu->uraian . '</td>';
        $childrens = \App\Models\Forminput::select([
                            'id',
                            'uraian',
                            'satuan',
                            'parent',
                            'hierarchy',
                            'provinsi_id',
                            'sektor_id',
                            'bidang_id',
                            'urusan_id',
                            'suburusan_id'
                        ])
                        ->where("parent", $menu->id)
                        ->where("suburusan_id", $menu->suburusan_id)
                        ->orderBy('hierarchy', 'asc')->get();
        if (count($childrens) == 0) {
            $str .= '<td>' . $satuan . '</td>';
            for ($y = $stryear; $y <= $endyear; $y++) {
                $dataSektoral = DB::table('sektorals')
                                ->select('sektorals_detail.qty')
                                ->leftJoin('sektorals_detail', 'sektorals.id', '=', 'sektorals_detail.sektoral_id')
                                ->where('sektorals.provinsi_id', $menu->provinsi_id)
                                ->where('sektorals.bidang_id', $menu->bidang_id)
                                ->where('sektorals.urusan_id', $menu->urusan_id)
                                ->where('sektorals.suburusan_id', $menu->suburusan_id)
                                ->where('sektorals.tahun', $y)
                                ->where('sektorals_detail.komponen_id', $menu->id)->first();
                if ($dataSektoral) {
                    $str .= '<td style="text-align: right;">' . $dataSektoral->qty . '</td>';
                } else {
                    $str .= '<td></td>';
                }
            }
        } else {
            $str .= '<td></td>';
            for ($y = $stryear; $y <= $endyear; $y++) {
                $str .= '<td></td>';
            }
        }

        if (count($childrens) > 0) {
            $space .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            foreach ($childrens as $children) {
                $str .= MenuHelper::print_form_report($stryear, $endyear, $children, $rowNo, $space);
            }
        }
        $str .= '</tr>';
        return $str;
    }

    public static function print_form_editor($menu, $rowNo = '') {
        //$editing = \Collective\Html\FormFacade::open(['route' => ['forminput.destroy', $menu->id], 'method' => 'DELETE', 'style' => 'display:inline']);
        //$editing = '<button class="btn btn-xs btn-danger pull-right btn-menu-remove"><i class="fa fa-times"></i></button>';
        //$editing .= '<button class="btn btn-xs btn-warning pull-right btn-menu-edit"><i class="fa fa-edit"></i></button>';
        $editing = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $menu->id . '" data-original-title="Edit" class="btn btn-xs btn-warning pull-right btn-menu-edit"><i class="fas fa-pencil-alt"></i></a> ';
        $editing .= '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $menu->id . '" data-original-title="Delete" class="btn btn-xs btn-danger pull-right btn-menu-remove"><i class="fa fa-times"></i></a>';
        //$editing .= \Collective\Html\FormFacade::close();

        $rowNo .= ($rowNo == '') ? $menu->hierarchy : '.' . $menu->hierarchy;

        if ($menu->type != "module") {
            $info = (object) array();
            $info->id = $menu->id;
            $info->name = $menu->name;
            $info->url = $menu->url;
            $info->type = $menu->type;

            //$editing .= '<a class="editMenuBtn btn btn-xs btn-success pull-right" info=\'' . json_encode($info) . '\'><i class="fa fa-edit"></i></a>';
        }
        $satuan = ($menu->satuan) ? ' ( ' . $menu->satuan . ' ) ' : '';
        $str = '<li class="dd-item dd3-item" data-id="' . $menu->id . '">
			<div class="dd-handle dd3-handle"></div>
			<div class="dd3-content">' . $rowNo . '. ' . $menu->uraian . $satuan . $editing . '</div>';
        $childrens = \App\Models\Forminput::select([
                            'id',
                            'uraian',
                            'satuan',
                            'parent',
                            'hierarchy',
                            'suburusan_id',
                            'urusan_id',
                            'bidang_id',
                            'sektor_id',
                            'provinsi_id'
                        ])
                        ->where("parent", $menu->id)
                        ->where("suburusan_id", $menu->suburusan_id)
                        ->orderBy('hierarchy', 'asc')->get();

        if (count($childrens) > 0) {
            $str .= '<ol class="dd-list">';
            foreach ($childrens as $children) {
                $str .= MenuHelper::print_form_editor($children, $rowNo);
            }
            $str .= '</ol>';
        }
        $str .= '</li>';
        return $str;
    }

    public static function print_menu() {
        $menuItems = \App\Models\Menus::select([
                    'menus.id',
                    'modules.name',
                    'modules.url',
                    'modules.fa_icon AS icon'
                ])->leftJoin('modules', 'modules.id', '=', 'menus.module_id')
                ->leftJoin('role_module', 'role_module.module_id', '=', 'modules.id')
                ->where("menus.parent", 0)
                ->where("role_module.role_id", Auth::user()->role_id)
                ->where("role_module.acc_view", 1)
                ->orderBy('menus.hierarchy', 'asc')
                ->get();
        $menuItem = [];
        foreach ($menuItems as $key) {
            $menuItem[] = static::print_child($key);
        }
        return $menuItem;
    }

    public static function print_child($menu) {
        $childrens = \App\Models\Menus::select([
                    'menus.id',
                    'modules.name',
                    'modules.url',
                    'modules.fa_icon AS icon'
                ])->leftJoin('modules', 'modules.id', '=', 'menus.module_id')
                ->leftJoin('role_module', 'role_module.module_id', '=', 'modules.id')
                ->where("menus.parent", $menu->id)
                ->where("role_module.role_id", Auth::user()->role_id)
                ->where("role_module.acc_view", 1)
                ->orderBy('menus.hierarchy', 'asc')
                ->get();
        $menuItem = array();
        $icon = 'fa fa-user';
        $fg = 'child';
        if (count($childrens) > 0) {
            $icon = 'fa fa-users';
            $fg = 'parent';
            foreach ($childrens as $children) {
                $menuItem[] = static::print_child($children);
            }
        }
        if ($menuItem) {
            $str = array(
                'id' => $menu->id,
                'text' => $menu['name'],
                'icon' => 'far ' . $menu['icon'],
                'submenu' => $menuItem,
                'active' => 'true',
                'href' => $menu['url'],
                'class' => '',
                'submenu_class' => ''
            );
        } else {
            $str = array(
                'id' => $menu->id,
                'text' => $menu['name'],
                'url' => $menu['url'],
                'icon' => $menu['icon'],
                'active' => '',
                'href' => Illuminate\Support\Facades\URL::to($menu['url']),
                'class' => ''
            );
        }

        return $str;
    }

    public static function real_module_name($name) {
        $name = str_replace('_', ' ', $name);
        return $name;
    }

    public static function print_form_report_pdf($stryear, $endyear, $menu, $rowNo = '', $space = '') {
        $rowNo .= ($rowNo == '') ? $menu->hierarchy : '.' . $menu->hierarchy;
        $satuan = ($menu->satuan) ? $menu->satuan : '';
        $str = '<tr>';
        $str .= '<td style="text-align: left; border-bottom: 1px solid #000000;border-left: 1px solid #000000;">' . $space . $rowNo . '. ' . $menu->uraian . '</td>';
        $childrens = \App\Models\Forminput::select([
                            'id',
                            'uraian',
                            'satuan',
                            'parent',
                            'hierarchy',
                            'provinsi_id',
                            'sektor_id',
                            'bidang_id',
                            'urusan_id',
                            'suburusan_id'
                        ])
                        ->where("parent", $menu->id)
                        ->where("suburusan_id", $menu->suburusan_id)
                        ->orderBy('hierarchy', 'asc')->get();
        if (count($childrens) == 0) {
            $str .= '<td style="text-align: center; border-bottom: 1px solid #000000;border-left: 1px solid #000000; border-right: 1px solid #000000;">' . $satuan . '</td>';
            for ($y = $stryear; $y <= $endyear; $y++) {
                $dataSektoral = DB::table('sektorals')
                                ->select('sektorals_detail.qty')
                                ->leftJoin('sektorals_detail', 'sektorals.id', '=', 'sektorals_detail.sektoral_id')
                                ->where('sektorals.provinsi_id', $menu->provinsi_id)
                                ->where('sektorals.bidang_id', $menu->bidang_id)
                                ->where('sektorals.urusan_id', $menu->urusan_id)
                                ->where('sektorals.suburusan_id', $menu->suburusan_id)
                                ->where('sektorals.tahun', $y)
                                ->where('sektorals_detail.komponen_id', $menu->id)->first();
                if ($dataSektoral) {
                    $str .= '<td style="text-align: right; border-bottom: 1px solid #000000;border-right: 1px solid #000000;">' . $dataSektoral->qty . '</td>';
                } else {
                    $str .= '<td style="text-align: left; border-bottom: 1px solid #000000;border-right: 1px solid #000000;"></td>';
                }
            }
        } else {
            $str .= '<td style="text-align: left; border-bottom: 1px solid #000000;border-left: 1px solid #000000; border-right: 1px solid #000000;"></td>';
            for ($y = $stryear; $y <= $endyear; $y++) {
                $str .= '<td style="text-align: left; border-bottom: 1px solid #000000;border-right: 1px solid #000000;"></td>';
            }
        }

        if (count($childrens) > 0) {
            $space .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            foreach ($childrens as $children) {
                $str .= MenuHelper::print_form_report_pdf($stryear, $endyear, $children, $rowNo, $space);
            }
        }
        $str .= '</tr>';
        return $str;
    }

    public static function print_form_master_pdf($stryear, $endyear, $menu, $rowNo = '', $space = '') {
        $rowNo .= ($rowNo == '') ? $menu->hierarchy : '.' . $menu->hierarchy;
        $satuan = ($menu->satuan) ? $menu->satuan : '';
        $str = '<tr>';
        $str .= '<td style="text-align: left; border-bottom: 1px solid #000000;border-left: 1px solid #000000;">' . $space . $rowNo . '. ' . $menu->uraian . '</td>';
        $childrens = \App\Models\Forminput::select([
                            'id',
                            'uraian',
                            'satuan',
                            'parent',
                            'hierarchy',
                            'provinsi_id',
                            'sektor_id',
                            'bidang_id',
                            'urusan_id',
                            'suburusan_id'
                        ])
                        ->where("parent", $menu->id)
                        ->where("suburusan_id", $menu->suburusan_id)
                        ->orderBy('hierarchy', 'asc')->get();
        if (count($childrens) == 0) {
            $str .= '<td style="text-align: center; border-bottom: 1px solid #000000;border-left: 1px solid #000000; border-right: 1px solid #000000;">' . $satuan . '</td>';
        } else {
            $str .= '<td style="text-align: left; border-bottom: 1px solid #000000;border-left: 1px solid #000000; border-right: 1px solid #000000;"></td>';
        }

        if (count($childrens) > 0) {
            $space .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            foreach ($childrens as $children) {
                $str .= MenuHelper::print_form_master_pdf($stryear, $endyear, $children, $rowNo, $space);
            }
        }
        $str .= '</tr>';
        return $str;
    }

    public static function print_menu_topic() {
        $topic = \App\Models\Group::select(['name', 'slug', 'icon'])->orderBy('hierarchy', 'asc')->get();
        return $topic;
    }

}
