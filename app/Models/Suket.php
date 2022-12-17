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
class Suket extends Model {

    //put your code here
    use HasFactory;

    protected $table = 'sim_suket';
    protected $fillable = [
        //put your code here
        'no_surat',
        'company_id',
        'tgl_surat',
        'lampiran',
        'lampiran_path',
        'status',
        'step',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'biodata_upt_id',
        'id_pemeriksaan',
        'jml_obyek',
        'id_type_pem',
        'reason'
    ];

    public function storeData($input) {
        return static::create($input);
    }

}
