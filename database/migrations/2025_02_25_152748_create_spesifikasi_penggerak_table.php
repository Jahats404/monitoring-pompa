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
        Schema::create('spesifikasi_penggerak', function (Blueprint $table) {
            $table->string('id_spesifikasi_penggerak')->primary()->unique();
            $table->string('type')->nullable();
            $table->string('no_series');
            $table->string('kapasitas_penggerak')->nullable();
            $table->string('ampere')->nullable();
            $table->year('tahun_pengadaan')->nullable();
            $table->string('kode_bearing_elmot')->nullable();

            $table->string('pompa_id');
            $table->foreign('pompa_id')->references('id_pompa')->on('pompa')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spesifikasi_penggerak');
    }
};