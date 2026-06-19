<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

define('LARAVEL_START', microtime(true));

// ── 1. Create all writable dirs in /tmp BEFORE Laravel boots ───────────────
$storagePath = '/tmp/storage';
$dirs = [
    $storagePath . '/app/public',
    $storagePath . '/framework/cache/data',
    $storagePath . '/framework/sessions',
    $storagePath . '/framework/views',
    $storagePath . '/logs',
];
foreach ($dirs as $dir) {
    if (!is_dir($dir)) mkdir($dir, 0755, true);
}

// ── 2. Set env vars BEFORE autoload so config picks them up ────────────────
$_SERVER['APP_STORAGE']        = $storagePath;
$_SERVER['VIEW_COMPILED_PATH'] = $storagePath . '/framework/views';
$_SERVER['SESSION_DRIVER']     = 'array';
$_SERVER['CACHE_STORE']        = 'array';
$_SERVER['LOG_CHANNEL']        = 'stderr';

putenv('APP_STORAGE='         . $storagePath);
putenv('VIEW_COMPILED_PATH='  . $storagePath . '/framework/views');
putenv('SESSION_DRIVER=array');
putenv('CACHE_STORE=array');
putenv('LOG_CHANNEL=stderr');

// ── 3. Autoload ─────────────────────────────────────────────────────────────
require __DIR__ . '/../vendor/autoload.php';

// ── 4. Boot app, override storage path immediately ──────────────────────────
$app = require_once __DIR__ . '/../bootstrap/app.php';

// This must happen before any service provider resolves 'view'
$app->useStoragePath($storagePath);

// Bind the compiled view path into the container directly
$app->instance('path.storage', $storagePath);

// ── 5. Handle request ───────────────────────────────────────────────────────
$kernel   = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);
$response->send();
$kernel->terminate($request, $response);