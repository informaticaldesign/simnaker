<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model {

    use HasFactory;

    protected $fillable = [
        'name',
        'label',
        'description',
        'fa_icon',
    ];

    public function storeData($input) {
        return static::create([
                    'name' => $input['name'],
                    'label' => $input['label'],
                    'description' => $input['description']
        ]);
    }

}
