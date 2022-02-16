<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dataset extends Model {

    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'slug',
        'description',
        'id_topic',
        'id_organization',
        'counter',
        'api_id',
        'created_by',
        'updated_by',
        'status',
        'home_view',
        'chart_type'
    ];

    public function storeData($input) {
        return static::create([
                    'title' => $input['title'],
                    'slug' => $input['slug'],
                    'description' => $input['description'],
                    'id_topic' => $input['id_topic'],
                    'id_organization' => $input['id_organization'],
                    'counter' => $input['counter'],
                    'status' => $input['status'],
                    'created_by' => $input['created_by'],
                    'api_id' => $input['api_id'],
                    'home_view' => $input['home_view'],
                    'chart_type' => $input['chart_type'],
        ]);
    }

}
