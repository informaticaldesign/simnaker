<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menus extends Model {

    use HasFactory;

    protected $table = 'menus';
    protected $fillable = [
        'module_id',
        'hierarchy',
        'parent'
    ];

    public function storeData($input) {
        return static::create([
                    'module_id' => $input['module_id'],
                    'hierarchy' => 0,
                    'parent' => 0,
        ]);
    }

}
