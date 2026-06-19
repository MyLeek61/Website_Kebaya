<?php

return [
    'paths' => [
        resource_path('views'),
    ],
    // Menggunakan variabel lingkungan yang kita set di index.php
    'compiled' => env('VIEW_COMPILED_PATH', realpath(storage_path('framework/views'))),
];