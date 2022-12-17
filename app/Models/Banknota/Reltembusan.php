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
class Reltembusan extends Model {

    protected $table = 'sim_banknota_rel_tembusan';
    protected $fillable = [
        'banknota_id',
        'tembusan_id',
        'description',
    ];

}
