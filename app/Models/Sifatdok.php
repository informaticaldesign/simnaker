<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Description of Provinsi
 *
 * @author heryhandoko
 */
class Sifatdok extends Model {

    //put your code here
    use HasFactory;

    protected $table = 'm_sifat_doc';
    protected $fillable = [
        'name',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    public function storeData($input) {
        return static::create($input);
    }

}
