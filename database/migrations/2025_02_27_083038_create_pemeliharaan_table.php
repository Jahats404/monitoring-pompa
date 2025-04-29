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
            $table->unsignedBigInteger('user_id');
            $table->text('uraian_pemeliharaan')->nullable();
            $table->text('keterangan')->nullable();

            $table->string('unit_pompa_id');
            $table->foreign('unit_pompa_id')->references('id_unit_pompa')->on('unit_pompa');
            $table->foreign('user_id')->references('id')->on('users');
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