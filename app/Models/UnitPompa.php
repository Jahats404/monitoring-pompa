<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitPompa extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_unit_pompa';
    protected $table = 'unit_pompa';
    protected $guarded = [];
    protected $casts = [
        'id_unit_pompa' => 'string'
    ];

    public function pompa()
    {
        return $this->belongsTo(Pompa::class,'pompa_id','id_pompa');
    }
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class,'lokasi_id','id_lokasi');
    }
    public function pemeriksaan_main_pump()
    {
        return $this->hasMany(PemeriksaanMainPump::class,'unit_pompa_id','id_unit_pompa');
    }
    public function pemeriksaan_charging_pump()
    {
        return $this->hasMany(PemeriksaanChargingPump::class,'unit_pompa_id','id_unit_pompa');
    }
    public function pemeliharaan()
    {
        return $this->hasMany(Pemeliharaan::class,'unit_pompa_id','id_unit_pompa');
    }
}