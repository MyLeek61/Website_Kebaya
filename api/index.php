<?php
// Tangkap semua jenis error
register_shutdown_function(function() {
    $error = error_get_last();
    if ($error !== null) {
        var_dump($error); // This will output the error to the browser
    }
});
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Pastikan path penyimpanan adalah /tmp
putenv('APP_STORAGE=/tmp');
putenv('VIEW_COMPILED_PATH=/tmp');

// Tambahkan pencegahan agar tidak crash saat memuat bootstrap
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Jalankan kernel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);
$response->send();
$kernel->terminate($request, $response);