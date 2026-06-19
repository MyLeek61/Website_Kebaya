<?php
// Tampilkan error jika ada agar kita tahu masalahnya
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Set path agar Laravel bisa menulis cache di folder sementara Vercel
putenv('VIEW_COMPILED_PATH=/tmp');
putenv('APP_STORAGE=/tmp');

// Load aplikasi
require __DIR__ . '/../public/index.php';