<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jnspemeriksaan extends Model
{

    use HasFactory;
    protected $table = 'jenis_pemeriksaan';
    protected $fillable = [
        'id',
        'name'
    ];

    public function storeData($input)
    {
        return static::create($input);
    }
}
