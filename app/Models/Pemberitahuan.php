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
class Pemberitahuan extends Model {

    //put your code here
    use HasFactory;

    protected $table = 'sim_pemberitahuan';
    protected $fillable = [
        'no_idx',
        'tgl_notif',
        'uraian',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'status',
        'renja_id'
    ];

    public function storeData($input) {
        return static::create($input);
    }

}
