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
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');        // Pertanyaan FAQ
            $table->text('answer');            // Jawaban FAQ
            $table->uuid('id_paket');
            $table->timestamps();             // Kolom created_at dan updated_at
            $table->foreign('id_paket')->references('id')->on('paket_wisata')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};