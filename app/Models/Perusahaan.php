<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{

    use HasFactory;
    protected $table = 'perusahaans';
    protected $fillable = [
        'id',
        'name'
    ];

    public function storeData($input)
    {
        return static::create($input);
    }
}
