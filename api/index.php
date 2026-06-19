<?php
// Tampilkan semua error ke output agar terlihat di log Vercel
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Set path ke /tmp agar bisa ditulis
putenv('VIEW_COMPILED_PATH=/tmp');
putenv('APP_STORAGE=/tmp');

// Load aplikasi secara langsung
require __DIR__ . '/../public/index.php';