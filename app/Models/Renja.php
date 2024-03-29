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
 * Description of Renja
 *
 * @author heryhandoko
 */
class Renja extends Model {

    //put your code here
    use HasFactory;

    protected $table = 'sim_renja';
    protected $fillable = [
        'jenis_kegiatan',
        'tgl_pelaksanaan',
        'company_id',
        'status',
        'keterangan',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'color',
        'type_kegiatan',
        'approval_next'
    ];

    public function storeData($input) {
        return static::create($input);
    }

}
