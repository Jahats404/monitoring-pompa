<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanMainPump extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pemeriksaan_main_pump';
    protected $table = 'pemeriksaan_main_pump';
    protected $guarded = [];
    protected $casts = [
        'id_pemeriksaan_main_pump' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function unit_pompa()
    {
        return $this->belongsTo(UnitPompa::class,'unit_pompa_id','id_unit_pompa');
    }
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class,'lokasi_id','id_lokasi');
    }
}