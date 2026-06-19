<?php

return [
    'paths' => [
        resource_path('views'),
    ],
    // Paksa direktori cache views ke /tmp agar bisa ditulis di Vercel
    'compiled' => env('VIEW_COMPILED_PATH', realpath(sys_get_temp_dir() . '/laravel-views')),
];