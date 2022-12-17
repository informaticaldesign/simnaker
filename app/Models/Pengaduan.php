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
class Pengaduan extends Model
{

    //put your code here
    use HasFactory;

    protected $table = 'sim_pengaduan';
    protected $fillable = [
        'id',
        'jenis',
        'name',
        'email',
        'phone',
        'kategori',
        'lokasi',
        'judul',
        'laporan',
        'status',
        'created_at',
        'slug',
        'lampiran',
        'lampiran_path',
    ];

    public function storeData($input)
    {
        return static::create($input);
    }
}
