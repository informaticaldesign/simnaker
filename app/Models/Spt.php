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
class Spt extends Model {

    //put your code here
    use HasFactory;

    protected $table = 'sim_spt';
    protected $fillable = [
        'no_idx',
        'tgl_spt',
        'city_code',
        'uraian',
        'keperluan',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'suket_id',
        'status',
        'banknota_id',
        'renja_id'
    ];

    public function storeData($input) {
        return static::create($input);
    }

}
