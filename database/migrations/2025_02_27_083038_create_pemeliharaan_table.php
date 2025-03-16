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
        Schema::create('pemeliharaan', function (Blueprint $table) {
            $table->string('id_pemeliharaan')->primary()->unique();
            $table->date('tanggal_pemeliharaan');
            $table->text('uraian_pemeliharaan');
            $table->text('keterangan')->nullable();

            $table->string('pompa_id');
            $table->foreign('pompa_id')->references('id_pompa')->on('pompa');
            $table->string('lokasi_id');
            $table->foreign('lokasi_id')->references('id_lokasi')->on('lokasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeliharaan');
    }
};