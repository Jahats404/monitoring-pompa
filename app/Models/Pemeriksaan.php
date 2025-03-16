<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pemeriksaan';
    protected $table = 'pemeriksaan';
    protected $guarded = [];
    protected $casts = [
        'id_pemeriksaan' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}