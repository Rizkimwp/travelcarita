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
        Schema::create('itinerary', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_paket_wisata');
            $table->integer('hari_ke');
            $table->text('kegiatan');
            $table->string('waktu')->nullable();
            $table->timestamps();
            $table->foreign('id_paket_wisata')->references('id')->on('paket_wisata')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itinerary');
    }
};