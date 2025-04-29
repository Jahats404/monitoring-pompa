<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id_role');
    }
    public function pemeriksaan_main_pump()
    {
        return $this->hasMany(PemeriksaanMainPump::class,'user_id','id');
    }
    public function pemeriksaan_charging_pump()
    {
        return $this->hasMany(PemeriksaanChargingPump::class,'user_id','id');
    }
    public function pemeliharaan()
    {
        return $this->hasMany(Pemeliharaan::class,'user_id','id');
    }
    public function standar_main_pump()
    {
        return $this->hasMany(StandarMainPump::class,'user_id','id');
    }
    public function standar_charging_pump()
    {
        return $this->hasMany(StandarChargingPump::class,'user_id','id');
    }
}