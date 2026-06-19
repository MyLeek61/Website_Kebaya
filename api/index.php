<?php

// 1. Set environment variables terlebih dahulu
putenv('VIEW_COMPILED_PATH=/tmp');
putenv('APP_STORAGE=/tmp'); 

// 2. Load aplikasi setelah konfigurasi di atas siap
require __DIR__ . '/../public/index.php';