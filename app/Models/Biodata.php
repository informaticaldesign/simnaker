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
class Biodata extends Model {

    //put your code here
    use HasFactory;

    protected $table = 'sim_biodata';
    protected $fillable = [
        'name',
        'nip',
        'birth_place',
        'birth_date',
        'id_jabatan',
        'id_golongan',
        'id_pangkat',
        'id_uptd',
        'address',
        'id_kota',
        'id_provinsi',
        'latitude',
        'longitude',
        'email',
        'phone',
        'avatar',
        'status',
        'avatar_path',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'avatar_path'
    ];

    public function storeData($input) {
        return static::create($input);
    }

}
