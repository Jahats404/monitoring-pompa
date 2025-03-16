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
        Schema::create('detail_pompa', function (Blueprint $table) {
            $table->string('id_detail_pompa')->primary()->unique();
            $table->string('brand');
            $table->string('kode_bearing_pompa')->nullable();
            $table->string('jenis');
            $table->string('kapasitas');

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
        Schema::dropIfExists('detail_pompa');
    }
};