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
        Schema::create('standar_main_pump', function (Blueprint $table) {
            $table->string('id_standar_main_pump')->primary()->unique();
            $table->unsignedBigInteger('user_id');
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
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('standar_main_pump');
    }
};