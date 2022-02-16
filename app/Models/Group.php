<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model {

    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'slug',
        'icon',
        'hierarchy'
    ];

    public function storeData($input) {
        return static::create([
                    'name' => $input['name'],
                    'slug' => $input['slug'],
                    'hierarchy' => $input['hierarchy'],
                    'icon' => $input['icon']
        ]);
    }

}
