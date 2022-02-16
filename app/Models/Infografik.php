<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infografik extends Model {

    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'slug',
        'icon',
        'id_topic',
        'id_organization',
        'description',
        'counter',
        'created_by',
        'updated_by'
    ];

    public function storeData($input) {
        return static::create([
                    'name' => $input['name'],
                    'slug' => $input['slug'],
                    'icon' => $input['icon'],
                    'id_organization' => $input['id_organization'],
                    'id_topic' => $input['id_topic'],
                    'description' => $input['description'],
                    'counter' => 0
        ]);
    }

}
