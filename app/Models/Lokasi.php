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
    
    public function unit_pompa()
    {
        return $this->hasMany(UnitPompa::class,'lokasi_id','id_lokasi');
    }
    public function pemeriksaan_main_pump()
    {
        return $this->hasMany(PemeriksaanMainPump::class,'lokasi_id','id_lokasi');
    }
    public function pemeriksaan_charging_pump()
    {
        return $this->hasMany(PemeriksaanChargingPump::class,'lokasi_id','id_lokasi');
    }
}