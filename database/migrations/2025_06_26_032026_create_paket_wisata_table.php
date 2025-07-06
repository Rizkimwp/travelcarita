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
        Schema::create('paket_wisata', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_paket');
            $table->uuid('id_jenis_paket');
            $table->text('deskripsi');
            $table->integer('durasi_hari');
            $table->decimal('harga', 10, 2);
            $table->decimal('diskon', 5, 2)->nullable();
            $table->timestamps();
            $table->foreign('id_jenis_paket')->references('id')->on('jenis_paket')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_wisata');
    }
};