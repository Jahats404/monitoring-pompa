<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandarChargingPump extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_standar_charging_pump';
    protected $table = 'standar_charging_pump';
    protected $guarded = [];
    protected $casts = [
        'id_standar_charging_pump' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function unit_pompa()
    {
        return $this->belongsTo(UnitPompa::class,'unit_pompa_id','id_unit_pompa');
    }
}