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
class Company extends Model {

    //put your code here
    use HasFactory;

    protected $table = 'm_company';
    protected $fillable = [
        'nib',
        'no_wlkp',
        'name',
        'address',
        'id_provinsi',
        'id_kota',
        'prov_code',
        'city_code',
        'kec_code',
        'kel_code',
        'registrasi_no',
        'sektor_code',
        'email',
        'phone',
        'longitude',
        'latitude',
        'npp_bpjs',
        'no_npwp',
        'pemeriksa',
        'nik_ktp_p',
        'penanggung_jwb',
        'nik_ktp_t',
        'jenis_usaha',
        'bidang_usaha',
        'password',
        'logo',
        'logo_path',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'slug',
        'comp_type',
        'filenpwp',
        'filenpwp_path',
        'fileakta',
        'fileakta_path',
        'status'
    ];

    public function storeData($input) {
        return static::create($input);
    }

}
