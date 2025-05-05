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
        Schema::create('pompa', function (Blueprint $table) {
            $table->string('id_pompa')->unique()->primary();
            $table->string('deskripsi_pompa');
            $table->string('jenis_cairan');
            $table->text('file_pompa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pompa');
    }
};