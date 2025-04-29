<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanChargingPump extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_pemeriksaan_charging_pump';
    protected $table = 'pemeriksaan_charging_pump';
    protected $guarded = [];
    protected $casts = [
        'id_pemeriksaan_charging_pump' => 'string'
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
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