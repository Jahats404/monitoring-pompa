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
        Schema::create('pemeriksaan', function (Blueprint $table) {
            $table->string('id_pemeriksaan')->primary()->unique();
            $table->date('tanggal_pemeriksaan');
            $table->string('flow_rate');
            $table->string('suction');
            $table->string('discharge');
            $table->string('de_motor_v');
            $table->string('de_motor_h');
            $table->string('de_motor_a');
            
            $table->string('nde_motor_v');
            $table->string('nde_motor_h');
            $table->string('nde_motor_a');
            
            $table->string('de_pump_v');
            $table->string('de_pump_h');
            $table->string('de_pump_a');

            $table->string('temp_casing_pump');
            $table->string('temp_mech_seal');
            $table->string('temp_bearing_pump_de');
            $table->string('temp_bearing_pump_nde');
            $table->string('temp_bearing_motor_de');
            $table->string('temp_bearing_motor_nde');
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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