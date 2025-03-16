<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pompa extends Model
{
    use HasFactory;

    protected $table = 'pompa';
    protected $primaryKey = 'id_pompa';
    protected $guarded = [];
    protected $casts = [
        'id_pompa' => 'string',
    ];

    public function detail_pompa()
    {
        return $this->hasOne(DetailPompa::class, 'pompa_id','id_pompa');
    }
    public function spesifikasi_penggerak()
    {
        return $this->hasOne(SpesifikasiPenggerak::class,'pompa_id','id_pompa');
    }
    public function mechanical_seal()
    {
        return $this->hasOne(MechanicalSeal::class,'pompa_id','id_pompa');
    }
    public function unit_pompa()
    {
        return $this->hasMany(UnitPompa::class,'pompa_id','id_pompa');
    }
    public function pemeliharaan()
    {
        return $this->hasMany(Pemeliharaan::class,'pompa_id','id_pompa');
    }
}