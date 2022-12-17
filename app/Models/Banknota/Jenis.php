<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models\Banknota;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Jenis Bank Nota
 *
 * @author heryhandoko
 */
class Jenis extends Model {

    protected $table = 'sim_banknota_jenis';
    protected $fillable = [
        'uuid',
        'name',
        'description',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

}
