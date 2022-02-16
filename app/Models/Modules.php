<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Modules extends Model {

    use HasFactory,
        Notifiable;

    protected $fillable = [
        'name',
        'label',
        'url',
        'fa_icon',
    ];

    public function storeData($input) {
        return static::create([
                    'name' => $input['name'],
                    'label' => $input['label'],
                    'fa_icon' => $input['fa_icon'],
                    'url' => $input['url'],
        ]);
    }

    public static function getRoleAccess($roleId = 0) {
        return Modules::select(['modules.id',
                            'modules.name',
                            'role_module.acc_view',
                            'role_module.acc_create',
                            'role_module.acc_edit',
                            'role_module.acc_delete'])
                        ->leftJoin('role_module', function($join) use($roleId) {
                            $join->on('role_module.module_id', '=', 'modules.id')
                            ->where('role_module.role_id', '=', $roleId);
                        })->get();
    }

    public static function getProvinsiAccess($roleId = 0) {
        return Provinsi::select(['provinsis.id',
                            'provinsis.name',
                            'role_provinsi.acc_view'
                        ])
                        ->leftJoin('role_provinsi', function($join) use($roleId) {
                            $join->on('role_provinsi.provinsi_id', '=', 'provinsis.id')
                            ->where('role_provinsi.role_id', '=', $roleId);
                        })->get();
    }

    public static function getSektorAccess($roleId = 0) {
        return Sektor::select(['sektors.id',
                            'provinsis.name AS provinsi_name',
                            'sektors.name',
                            'role_sektor.acc_view'
                        ])->leftJoin('provinsis', 'provinsis.id', '=', 'sektors.provinsi_id')
                        ->leftJoin('role_sektor', function($join) use($roleId) {
                            $join->on('role_sektor.sektor_id', '=', 'sektors.id')
                            ->where('role_sektor.role_id', '=', $roleId);
                        })->whereIn('provinsi_id', function($query) use($roleId) {
                    $query->select('provinsi_id')
                            ->from('role_provinsi')
                            ->where('role_id', $roleId)
                            ->where('acc_view', 1);
                })->get();
    }

    public static function getOpdAccess($roleId = 0) {
        return Bidang::select(['bidangs.id',
                            'sektors.name AS sektor_name',
                            'bidangs.name',
                            'role_opd.acc_view'
                        ])->leftJoin('sektors', 'sektors.id', '=', 'bidangs.sektor_id')
                        ->leftJoin('role_opd', function($join) use($roleId) {
                            $join->on('role_opd.opd_id', '=', 'bidangs.id')
                            ->where('role_opd.role_id', '=', $roleId);
                        })->whereIn('sektor_id', function($query) use($roleId) {
                    $query->select('sektor_id')
                            ->from('role_sektor')
                            ->where('role_id', $roleId)
                            ->where('acc_view', 1);
                })->get();
    }

    public static function getUrusanAccess($roleId = 0) {
        return Urusan::select(['urusans.id',
                            'bidangs.name AS opd_name',
                            'urusans.name',
                            'role_urusan.acc_view'
                        ])->leftJoin('bidangs', 'bidangs.id', '=', 'urusans.bidang_id')
                        ->leftJoin('role_urusan', function($join) use($roleId) {
                            $join->on('role_urusan.urusan_id', '=', 'urusans.id')
                            ->where('role_urusan.role_id', '=', $roleId);
                        })->whereIn('bidang_id', function($query) use($roleId) {
                    $query->select('opd_id')
                            ->from('role_opd')
                            ->where('role_id', $roleId)
                            ->where('acc_view', 1);
                })->orderBy('bidangs.name', 'ASC')->get();
    }

    public static function getSuburusanAccess($roleId = 0) {
        return Suburusan::select(['suburusans.id',
                            'bidangs.name AS opd_name',
                            'urusans.name AS urusan_name',
                            'suburusans.name',
                            'role_suburusan.acc_view'
                        ])->leftJoin('urusans', 'urusans.id', '=', 'suburusans.urusan_id')
                        ->leftJoin('bidangs', 'bidangs.id', '=', 'urusans.bidang_id')
                        ->leftJoin('role_suburusan', function($join) use($roleId) {
                            $join->on('role_suburusan.suburusan_id', '=', 'suburusans.id')
                            ->where('role_suburusan.role_id', '=', $roleId);
                        })->whereIn('urusan_id', function($query) use($roleId) {
                    $query->select('urusan_id')
                            ->from('role_urusan')
                            ->where('role_id', $roleId)
                            ->where('acc_view', 1);
                })->orderBy('bidangs.name', 'ASC')->get();
    }

}
