<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

define('LARAVEL_START', microtime(true));

// ── 1. Writable storage in /tmp (Vercel is read-only except /tmp) ──────────
$storagePath = '/tmp/storage';
$dirs = [
    $storagePath,
    $storagePath . '/app/public',
    $storagePath . '/framework/cache/data',
    $storagePath . '/framework/sessions',
    $storagePath . '/framework/views',
    $storagePath . '/logs',
];
foreach ($dirs as $dir) {
    if (!is_dir($dir)) mkdir($dir, 0755, true);
}

// ── 2. Point Laravel env vars at /tmp ──────────────────────────────────────
$_ENV['APP_STORAGE']          = $storagePath;
$_ENV['VIEW_COMPILED_PATH']   = $storagePath . '/framework/views';
$_ENV['SESSION_DRIVER']       = 'array';   // no file sessions on read-only FS
$_ENV['CACHE_DRIVER']         = 'array';   // no file cache on read-only FS
$_ENV['LOG_CHANNEL']          = 'stderr';  // logs go to Vercel log stream

putenv('APP_STORAGE='        . $storagePath);
putenv('VIEW_COMPILED_PATH=' . $storagePath . '/framework/views');
putenv('SESSION_DRIVER=array');
putenv('CACHE_DRIVER=array');
putenv('LOG_CHANNEL=stderr');

// ── 3. Bootstrap Laravel ────────────────────────────────────────────────────
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

// Override storage path so ALL of Laravel uses /tmp
$app->useStoragePath($storagePath);

$kernel   = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);
$response->send();
$kernel->terminate($request, $response);