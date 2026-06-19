<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

define('LARAVEL_START', microtime(true));

$storagePath = '/tmp/storage';
foreach ([
    $storagePath . '/app/public',
    $storagePath . '/framework/cache/data',
    $storagePath . '/framework/sessions',
    $storagePath . '/framework/views',
    $storagePath . '/logs',
] as $dir) {
    is_dir($dir) || mkdir($dir, 0755, true);
}

// Force debug ON so we can see the real error in Vercel logs
putenv('APP_DEBUG=true');
putenv('APP_ENV=local');
putenv('APP_STORAGE='        . $storagePath);
putenv('VIEW_COMPILED_PATH=' . $storagePath . '/framework/views');
putenv('SESSION_DRIVER=array');
putenv('CACHE_STORE=array');
putenv('LOG_CHANNEL=stderr');

$_SERVER['APP_DEBUG']          = 'true';
$_SERVER['APP_ENV']            = 'local';
$_SERVER['APP_STORAGE']        = $storagePath;
$_SERVER['VIEW_COMPILED_PATH'] = $storagePath . '/framework/views';
$_SERVER['SESSION_DRIVER']     = 'array';
$_SERVER['CACHE_STORE']        = 'array';
$_SERVER['LOG_CHANNEL']        = 'stderr';

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->useStoragePath($storagePath);
$app->instance('path.storage', $storagePath);

$kernel   = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);
$response->send();
$kernel->terminate($request, $response);