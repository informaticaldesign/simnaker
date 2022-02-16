<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengawasan extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'pemeriksa',
        'tgl_pemeriksaan',
        'perusahaan',
        'created_by',
        'updated_by',
    ];

    public function storeData($input)
    {
        return static::create($input);
    }
}
