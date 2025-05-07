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
        Schema::create('pemeriksaan_main_pump', function (Blueprint $table) {
            $table->string('id_pemeriksaan_main_pump')->primary()->unique();
            $table->date('tanggal_pemeriksaan');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('rpm')->nullable();
            $table->string('flow_rate')->nullable();
            $table->string('suction')->nullable();
            $table->string('discharge')->nullable();
            $table->string('produk_pemompaan')->nullable();
            $table->string('de_motor_v')->nullable();
            $table->string('de_motor_h')->nullable();
            $table->string('de_motor_a')->nullable();
            $table->string('de_motor_temperatur_casing')->nullable();
            
            $table->string('nde_motor_v')->nullable();
            $table->string('nde_motor_h')->nullable();
            $table->string('nde_motor_a')->nullable();
            $table->string('nde_motor_temperatur_casing')->nullable();

            $table->string('in_gearbox_de_v')->nullable();
            $table->string('in_gearbox_de_h')->nullable();
            $table->string('in_gearbox_de_a')->nullable();
            $table->string('in_gearbox_de_temperatur_casing')->nullable();
            
            $table->string('in_gearbox_nde_v')->nullable();
            $table->string('in_gearbox_nde_h')->nullable();
            $table->string('in_gearbox_nde_a')->nullable();
            $table->string('in_gearbox_nde_temperatur_casing')->nullable();


            $table->string('out_gearbox_de_v')->nullable();
            $table->string('out_gearbox_de_h')->nullable();
            $table->string('out_gearbox_de_a')->nullable();
            $table->string('out_gearbox_de_temperatur_casing')->nullable();
            
            $table->string('out_gearbox_nde_v')->nullable();
            $table->string('out_gearbox_nde_h')->nullable();
            $table->string('out_gearbox_nde_a')->nullable();
            $table->string('out_gearbox_nde_temperatur_casing')->nullable();

            
            $table->string('de_pump_v')->nullable();
            $table->string('de_pump_h')->nullable();
            $table->string('de_pump_a')->nullable();
            $table->string('de_pump_temperatur_casing')->nullable();

            $table->string('nde_pump_v')->nullable();
            $table->string('nde_pump_h')->nullable();
            $table->string('nde_pump_a')->nullable();
            $table->string('nde_pump_temperatur_casing')->nullable();

            $table->string('thurstbearing_v')->nullable();
            $table->string('thurstbearing_h')->nullable();
            $table->string('thurstbearing_a')->nullable();
            $table->string('thurstbearing_temperatur_casing')->nullable();

            $table->string('temperatur_cassing')->nullable();

            // $table->string('temp_casing_pump');
            // $table->string('temp_mech_seal');
            // $table->string('temp_bearing_pump_de');
            // $table->string('temp_bearing_pump_nde');
            // $table->string('temp_bearing_motor_de');
            // $table->string('temp_bearing_motor_nde');
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('unit_pompa_id');
            $table->foreign('unit_pompa_id')->references('id_unit_pompa')->on('unit_pompa')->cascadeOnDelete();
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
        Schema::dropIfExists('pemeriksaan');
    }
};