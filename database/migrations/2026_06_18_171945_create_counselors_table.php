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
        Schema::create('counselors', function (Blueprint $table) {
            $table->id(); // Primary Key otomatis (id)
            $table->string('slug')->unique(); // Untuk query parameter di URL (misal: ?counselor=salsa)
            $table->string('initials', 5); // Kolom initials (misal: SA, FA)
            $table->string('name'); // Kolom nama lengkap beserta gelar
            $table->string('specialization'); // Kolom spesialisasi
            $table->text('description'); // Kolom deskripsi profil (menggunakan text karena panjang)
            $table->string('satisfaction')->default('100% Puas'); // Kolom persentase kepuasan
            $table->timestamps(); // Menghasilkan kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counselors');
    }
};