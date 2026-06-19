<?php
// Tampilkan semua error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set path penyimpanan ke folder sementara Vercel
putenv('VIEW_COMPILED_PATH=/tmp');
putenv('APP_STORAGE=/tmp');

// Load aplikasi
require __DIR__ . '/../public/index.php';