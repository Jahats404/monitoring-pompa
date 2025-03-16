<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_lokasi';
    protected $table = 'lokasi';
    protected $guarded = [];
    protected $casts = [
        'id_lokasi' => 'string',
    ];
    
}