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
 * Description of Biodata
 *
 * @author heryhandoko
 */
class Visitors extends Model {

    //put your code here
    use HasFactory;

    protected $table = 'sim_visitors';
    protected $fillable = [
        'ip_address',
        'platform',
        'browser',
        'parent',
        'created_at',
        'updated_at',
    ];

    public function storeData($input) {
        return static::create($input);
    }

}
