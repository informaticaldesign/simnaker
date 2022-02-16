<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'no_registrasi',
        'address',
        'brand_id',
        'jenis_id',
        'tahun',
        'status_id',
        'status',
        'created_by',
        'user_id',
        'email',
        'code',
        'kec_id',
        'tgl_antrian'
    ];
    
}
