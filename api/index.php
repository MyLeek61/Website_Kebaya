<?php
// Tampilkan error jika ada
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Cek apakah PHP bisa melihat database?
// Ganti dengan kredensial Anda untuk tes sederhana
$host = getenv('DB_HOST') ? "Host ditemukan" : "Host TIDAK ditemukan";
echo "Status: Laravel Bootstrap Test. " . $host;

// Jika kode di atas memunculkan "Status: Laravel Bootstrap Test. Host ditemukan" di browser,
// maka masalahnya ada di konfigurasi Laravel/Database di dalam `public/index.php`.
exit();