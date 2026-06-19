<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    */

    'paths' => [
        resource_path('views'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    | Overridden via VIEW_COMPILED_PATH env var so Vercel (read-only FS)
    | can write compiled Blade files to /tmp instead of storage/.
    */

    'compiled' => env('VIEW_COMPILED_PATH', '/tmp/storage/framework/views'),

];