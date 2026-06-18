<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Counselor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================
        // 1. MEMBUAT / UPDATE AKUN DATA ADMIN
        // ==========================================
        User::updateOrCreate(
            ['email' => 'admin@kebaya.com'], // Patokan keunikan akun admin
            [
                'name'     => 'Administrator Kebaya',
                'password' => Hash::make('password123'),
                'role'     => 'admin', // Menandakan peran sebagai super admin
                'phone'    => '081299998888',
            ]
        );

        // ==========================================
        // 2. MEMBUAT / UPDATE AKUN CONTOH MAHASISWA
        // ==========================================
        User::updateOrCreate(
            ['email' => 'user@kebaya.com'],
            [
                'name'     => 'Malik Andhika',
                'password' => Hash::make('password123'),
                'role'     => 'user',
                'phone'    => '089876543210',
            ]
        );

        // ==========================================
        // 3. MEMBUAT / UPDATE AKUN & PROFIL KONSELOR
        // ==========================================

        // --- Konselor 1: Salsa Amalia ---
        $userSalsa = User::updateOrCreate(
            ['email' => 'salsa@kebaya.com'],
            [
                'name'     => 'Salsa Amalia, S.Psi.',
                'password' => Hash::make('password123'),
                'role'     => 'counselor',
                'phone'    => '081211112222',
            ]
        );

        Counselor::updateOrCreate(
            ['slug' => 'salsa'],
            [
                'user_id'        => $userSalsa->id,
                'initials'       => 'SA',
                'name'           => $userSalsa->name,
                'specialization' => 'Spesialis Akademik & Pribadi',
                'description'    => 'Fokus mendampingi mahasiswa dalam mengelola kecemasan akademik, manajemen waktu, burnout organisasi, serta pengembangan diri yang ramah dan aman.',
                'satisfaction'   => '98% Puas',
            ]
        );

        // --- Konselor 2: Fahri Alamsyah ---
        $userFahri = User::updateOrCreate(
            ['email' => 'fahri@kebaya.com'],
            [
                'name'     => 'Fahri Alamsyah, S.Psi.',
                'password' => Hash::make('password123'),
                'role'     => 'counselor',
                'phone'    => '081233334444',
            ]
        );

        Counselor::updateOrCreate(
            ['slug' => 'fahri'],
            [
                'user_id'        => $userFahri->id,
                'initials'       => 'FA',
                'name'           => $userFahri->name,
                'specialization' => 'Spesialis Karir & Bakat',
                'description'    => 'Membantu mahasiswa memetakan minat bakat, mengatasi quarter-life crisis, penulisan CV, serta persiapan menghadapi dunia kerja pasca-kampus.',
                'satisfaction'   => '95% Puas',
            ]
        );

        // --- Konselor 3: Arif Rahman ---
        $userArif = User::updateOrCreate(
            ['email' => 'arif@kebaya.com'],
            [
                'name'     => 'Arif Rahman, S.Psi.',
                'password' => Hash::make('password123'),
                'role'     => 'counselor',
                'phone'    => '081255556666',
            ]
        );

        Counselor::updateOrCreate(
            ['slug' => 'arif'],
            [
                'user_id'        => $userArif->id,
                'initials'       => 'AR',
                'name'           => $userArif->name,
                'specialization' => 'Spesialis Hubungan & Sosial',
                'description'    => 'Menyediakan ruang aman untuk berdiskusi seputar konflik pertemanan, masalah keluarga, adaptasi lingkungan baru, dan manajemen emosi sosial.',
                'satisfaction'   => '96% Puas',
            ]
        );
    }
}