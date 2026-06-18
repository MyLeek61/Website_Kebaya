<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            // ID Pengguna / Mahasiswa yang login
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // ID Konselor yang dipilih
            $table->foreignId('counselor_id')->constrained('counselors')->onDelete('cascade');
            
            // Detail Pilihan Jadwal & Keluhan
            $table->string('booking_method'); // 'chat' atau 'video'
            $table->date('booking_date');
            $table->string('booking_time'); // Contoh: '09:00'
            $table->text('client_notes')->nullable();

            // Sistem Validasi & Status Sesi (Sesuai Rancangan Anda)
            $table->string('penerimaan')->default('belum'); // 'belum', 'sudah'
            $table->string('status')->default('belum diterima'); // 'belum diterima', 'berjalan', 'sudah selesai'
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};