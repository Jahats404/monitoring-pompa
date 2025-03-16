<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MechanicalSeal extends Model
{
    use HasFactory;

    protected $table = 'mechanical_seal';
    protected $primaryKey = 'id_mechanical_seal';
    protected $guarded = [];
    protected $casts = [
        'string' => 'id_mechanical_seal',
    ];

    public function pompa()
    {
        return $this->belongsTo(Pompa::class,'pompa_id','id_pompa');
    }
}