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
        Schema::create('jadwal_keberangkatan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_paket');
            $table->date('tanggal_berangkat');
            $table->integer('sisa_kuota');
            $table->timestamps();
            $table->foreign('id_paket')->references('id')->on('paket_wisata')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_keberangkatan');
    }
};