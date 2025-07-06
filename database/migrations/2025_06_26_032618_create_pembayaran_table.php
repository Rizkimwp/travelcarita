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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_pemesanan');
            $table->enum('metode', ['transfer', 'ovo', 'gopay', 'dana']);
            $table->decimal('jumlah', 12, 2);
            $table->string('bukti')->nullable();
            $table->enum('tipe', ['dp', 'pelunasan']);
            $table->enum('status_verifikasi', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
            $table->timestamps();
            $table->foreign('id_pemesanan')->references('id')->on('pemesanan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};