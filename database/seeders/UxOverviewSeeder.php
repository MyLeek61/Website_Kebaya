<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UxOverviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat daftar user dummy
        for ($i = 1; $i <= 5; $i++) {
            $user = \App\Models\User::updateOrCreate(
                ['email' => "user{$i}@kebaya.com"],
                [
                    'name' => "User {$i}",
                    'password' => \Illuminate\Support\Facades\Hash::make('password123'),
                    'role' => 'user'
                ]
            );

            // Mengisi data UX
            \App\Models\UxOverview::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'kemudahan'  => rand(3, 5), // Nilai random untuk simulasi
                    'kejelasan' => rand(3, 5),
                    'dayatarik'  => rand(3, 5),
                    'kecepatan'  => rand(3, 5),
                    'kebergunaan'  => rand(3, 5),
                    'catatan'    => 'Responden dari migrasi data spreadsheet.'
                ]
            );
        }
    }
}
