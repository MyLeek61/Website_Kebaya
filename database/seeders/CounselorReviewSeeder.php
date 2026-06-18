<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Counselor;
use App\Models\CounselorReview;
use Illuminate\Database\Seeder;

class CounselorReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ambil user mahasiswa (Malik Andhika) sebagai pemberi review
        $student = User::where('role', 'user')->first();

        // Jika UserSeeder belum dijalankan atau tidak ada user mahasiswa, batalkan seeder
        if (!$student) {
            $this->command->warn('Seeder dilewati: Tidak ditemukan user dengan role "user". Jalankan UserSeeder terlebih dahulu.');
            return;
        }

        // 2. Ambil data para konselor untuk dipasangkan ke review
        $salsa = Counselor::where('slug', 'salsa')->first();
        $fahri = Counselor::where('slug', 'fahri')->first();
        $arif  = Counselor::where('slug', 'arif')->first();

        // 3. Data tiruan ulasan untuk masing-masing konselor
        $reviews = [];

        // --- REVIEW UNTUK KAK SALSA ---
        if ($salsa) {
            $reviews[] = [
                'counselor_id'        => $salsa->id,
                'user_id'             => $student->id,
                'case_category'       => 'Akademik',
                'rating_comfort'      => 5,
                'rating_impact'       => 4,
                'rating_safety'       => 5,
                'rating_accessibility'=> 4,
                'rating_relationship' => 5,
                'rating_average'      => 4.60,
                'review_text'         => 'Kak Salsa ramah sekali, membantu saya membagi target skripsi yang menumpuk jadi langkah kecil yang tidak bikin stress.',
            ];
            $reviews[] = [
                'counselor_id'        => $salsa->id,
                'user_id'             => $student->id,
                'case_category'       => 'Pribadi',
                'rating_comfort'      => 4,
                'rating_impact'       => 4,
                'rating_safety'       => 4,
                'rating_accessibility'=> 5,
                'rating_relationship' => 4,
                'rating_average'      => 4.20,
                'review_text'         => 'Sesi konseling yang menenangkan. Tempat bercerita yang aman tanpa takut dihakimi.',
            ];
            $reviews[] = [
                'counselor_id'        => $salsa->id,
                'user_id'             => $student->id,
                'case_category'       => 'Akademik',
                'rating_comfort'      => 5,
                'rating_impact'       => 5,
                'rating_safety'       => 5,
                'rating_accessibility'=> 4,
                'rating_relationship' => 5,
                'rating_average'      => 4.80,
                'review_text'         => 'Sangat terbantu dengan teknik Pomodoro yang disarankan untuk mengatasi burnout organisasi.',
            ];
        }

        // --- REVIEW UNTUK KAK FAHRI ---
        if ($fahri) {
            $reviews[] = [
                'counselor_id'        => $fahri->id,
                'user_id'             => $student->id,
                'case_category'       => 'Karir',
                'rating_comfort'      => 4,
                'rating_impact'       => 5,
                'rating_safety'       => 4,
                'rating_accessibility'=> 4,
                'rating_relationship' => 5,
                'rating_average'      => 4.40,
                'review_text'         => 'CV saya dikoreksi total dan sekarang jadi jauh lebih rapi. Penjelasan seputar persiapan magang juga sangat jelas.',
            ];
        }

        // --- REVIEW UNTUK KAK ARIF ---
        if ($arif) {
            $reviews[] = [
                'counselor_id'        => $arif->id,
                'user_id'             => $student->id,
                'case_category'       => 'Pribadi',
                'rating_comfort'      => 5,
                'rating_impact'       => 4,
                'rating_safety'       => 5,
                'rating_accessibility'=> 5,
                'rating_relationship' => 4,
                'rating_average'      => 4.60,
                'review_text'         => 'Bisa meredakan emosi setelah berkonflik berat dengan teman sekelompok. Solusi adaptasinya sangat masuk akal.',
            ];
        }

        // 4. Masukkan semua data ke tabel database
        foreach ($reviews as $reviewData) {
            CounselorReview::create($reviewData);
        }
    }
}