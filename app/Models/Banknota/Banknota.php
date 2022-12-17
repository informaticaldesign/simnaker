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
class Banknota extends Model {

    protected $table = 'sim_banknota';
    protected $fillable = [
        'uuid',
        'document_no',
        'description',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
        'kota',
        'jenis_id',
        'spt_id',
        'sifat_id',
        'perihal',
        'tanggal',
        'company_name',
        'company_id',
        'kadis_name',
        'kadis_nip',
        'pengawas_name',
        'pengawas_nip',
        'description_footer',
        'version',
        'parent_id',
        'reason'
    ];

}
