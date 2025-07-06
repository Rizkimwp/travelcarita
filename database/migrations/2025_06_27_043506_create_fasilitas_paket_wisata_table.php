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
        Schema::create('fasilitas_paket_wisata', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_paket_wisata');
            $table->uuid('id_fasilitas');
            $table->timestamps();

            $table->foreign('id_paket_wisata')->references('id')->on('paket_wisata')->onDelete('cascade');
            $table->foreign('id_fasilitas')->references('id')->on('fasilitas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas_paket_wisata');
    }
};