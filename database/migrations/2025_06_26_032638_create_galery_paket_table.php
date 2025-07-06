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
        Schema::create('galery_paket', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_paket_wisata');
            $table->enum('tipe', ['foto', 'video']);
            $table->text('url_media');
            $table->timestamps();
            $table->foreign('id_paket_wisata')->references('id')->on('paket_wisata')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galery_paket');
    }
};