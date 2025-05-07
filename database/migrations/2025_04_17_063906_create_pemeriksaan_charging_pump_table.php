<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pemeriksaan_charging_pump', function (Blueprint $table) {
            $table->string('id_pemeriksaan_charging_pump')->primary()->unique();
            $table->date('tanggal_pemeriksaan');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('flow_rate')->nullable();
            $table->string('suction')->nullable();
            $table->string('discharge')->nullable();

            $table->string('de_motor_v')->nullable();
            $table->string('de_motor_h')->nullable();
            $table->string('de_motor_a')->nullable();

            $table->string('nde_motor_v')->nullable();
            $table->string('nde_motor_h')->nullable();
            $table->string('nde_motor_a')->nullable();
            
            $table->string('de_pump_v')->nullable();
            $table->string('de_pump_h')->nullable();
            $table->string('de_pump_a')->nullable();

            $table->string('nde_pump_v')->nullable();
            $table->string('nde_pump_h')->nullable();
            $table->string('nde_pump_a')->nullable();

            $table->string('temp_casing_pump')->nullable();
            $table->string('temp_mech_seal')->nullable();

            $table->string('temp_bearing_pump_de')->nullable();
            $table->string('temp_bearing_pump_nde')->nullable();

            $table->string('temp_bearing_motor_de')->nullable();
            $table->string('temp_bearing_motor_nde')->nullable();
            
            $table->string('produk_pemompaan')->nullable();

            $table->string('unit_pompa_id');
            $table->foreign('unit_pompa_id')->references('id_unit_pompa')->on('unit_pompa')->cascadeOnDelete();
            
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('lokasi_id');
            $table->foreign('lokasi_id')->references('id_lokasi')->on('lokasi')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_charging_pump');
    }
};