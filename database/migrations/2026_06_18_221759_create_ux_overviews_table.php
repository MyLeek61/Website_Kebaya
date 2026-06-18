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
        Schema::create('ux_overviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Menghubungkan ke tabel users
            $table->integer('kemudahan'); // Skor 1-5
            $table->integer('kejelasan'); // Skor 1-5
            $table->integer('dayatarik');
            $table->integer('kecepatan');
            $table->integer('kebergunaan');
            $table->text('catatan')->nullable();
            $table->timestamps();
            });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ux_overviews');
    }
};
