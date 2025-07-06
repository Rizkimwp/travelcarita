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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_user');
            $table->uuid('id_paket');
            $table->uuid('id_jadwal');
            $table->integer('jumlah_peserta');
            $table->text('tambahan_layanan')->nullable();
            $table->decimal('total_harga', 12, 2);
            $table->enum('status_pembayaran', ['belum', 'dp', 'lunas'])->default('belum');
            $table->timestamps();
            $table->foreign('id_paket')->references('id')->on('paket_wisata')->onDelete('cascade');
            $table->foreign('id_jadwal')->references('id')->on('jadwal_keberangkatan')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};