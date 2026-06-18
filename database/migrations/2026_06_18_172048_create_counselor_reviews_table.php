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
       Schema::create('counselor_reviews', function (Blueprint $table) {
    $table->id();
    $table->foreignId('counselor_id')->constrained('counselors')->onDelete('cascade');
    $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
    
    // Pilihan topik masalah saat konsultasi (untuk bahan Pie Chart)
    // Contoh isi: 'Akademik', 'Pribadi', 'Karir', 'Sosial'
    $table->string('case_category'); 

    // Skor kriteria penilaian 1-5 (untuk bahan Bar Chart)
    $table->unsignedTinyInteger('rating_comfort');     // Kenyamanan
    $table->unsignedTinyInteger('rating_impact');      // Dampak / Hasil
    $table->unsignedTinyInteger('rating_safety');      // Rasa Aman
    $table->unsignedTinyInteger('rating_accessibility'); // Kemudahan Akses
    $table->unsignedTinyInteger('rating_relationship'); // Hubungan/Relasi dengan Konselor

    // Total rata-rata dari 5 kriteria di atas (opsional, untuk nilai rating bintang utama)
    $table->decimal('rating_average', 3, 2); 

    $table->text('review_text')->nullable(); // Testimoni tertulis
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counselor_reviews');
    }
};
