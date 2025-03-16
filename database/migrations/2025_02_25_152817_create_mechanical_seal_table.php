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
        Schema::create('mechanical_seal', function (Blueprint $table) {
            $table->string('id_mechanical_seal')->primary()->unique();
            $table->string('merk');
            $table->string('no_seri');

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
        Schema::dropIfExists('mechanical_seal');
    }
};