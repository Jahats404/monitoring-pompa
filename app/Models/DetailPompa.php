<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPompa extends Model
{
    use HasFactory;

    protected $table = 'detail_pompa';
    protected $primaryKey = 'id_detail_pompa';
    protected $guarded = [];
    protected $casts = [
        'id_detail_pompa' => 'string',
    ];

    public function pompa()
    {
        return $this->belongsTo(Pompa::class,'pompa_id','id_pompa');
    }
}