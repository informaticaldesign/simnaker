<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configs extends Model {

    use HasFactory;

    protected $fillable = [
        "key", "value"
    ];

    public static function getByKey($key) {
        $row = Configs::where('key', $key)->first();
        if (isset($row->value)) {
            return $row->value;
        } else {
            return false;
        }
    }

    // LAConfigs::getAll();
    public static function getAll() {
        $configs = array();
        $configs_db = Configs::all();
        foreach ($configs_db as $row) {
            $configs[$row->key] = $row->value;
        }
        return (object) $configs;
    }

}
