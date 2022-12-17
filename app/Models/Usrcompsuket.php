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
class Usrcompsuket extends Model {

    //put your code here
    use HasFactory;

    protected $table = 'sim_bio_comp_suket';
    protected $fillable = [
        'biodata_id',
        'company_id',
        'suket_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];

    public function storeData($input) {
        return static::create($input);
    }

}
