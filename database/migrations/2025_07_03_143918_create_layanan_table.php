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
        Schema::create('layanan', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID sebagai primary key
            $table->uuid('id_fasilitas');
            $table->string('title');
            $table->string('path')->nullable();
            $table->decimal('harga', 15, 2); // harga per jam
            $table->integer('lama_sewa'); // dalam jam
            $table->dateTime('mulai_sewa'); // waktu mulai sewa
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('id_fasilitas')->references('id')->on('fasilitas')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};