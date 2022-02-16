<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'no_surat',
        'jml_lampiran',
        'perihal',
        'no_spt',
        'tgl_spt',
        'sifat',
        'perusahaan',
        'jns_pemeriksaan',
        'created_by',
        'updated_by',
    ];

    public function storeData($input)
    {
        return static::create($input);
    }
}
