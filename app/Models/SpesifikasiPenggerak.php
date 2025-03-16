<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpesifikasiPenggerak extends Model
{
    use HasFactory;

    protected $table = 'spesifikasi_penggerak';
    protected $primaryKey = 'id_spesifikasi_penggerak';
    protected $guarded = [];
    protected $casts = [
        'id_spesifikasi_penggerak' => 'string',
    ];

    public function pompa()
    {
        return $this->belongsTo(Pompa::class,'pompa_id','id_pompa');
    }
}