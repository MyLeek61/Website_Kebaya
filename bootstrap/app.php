<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// ── 1. Create writable dirs in /tmp ────────────────────────────────────────
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

// ── 2. Make bootstrap/cache writable by symlinking to /tmp ─────────────────
// PackageManifest needs to write packages.php and services.php here
$bootstrapCache = __DIR__ . '/cache';
$tmpBootstrap   = '/tmp/bootstrap-cache';

if (!is_dir($tmpBootstrap)) {
    mkdir($tmpBootstrap, 0755, true);
}

// Copy any existing cache files to /tmp so they're available
if (is_dir($bootstrapCache)) {
    foreach (glob($bootstrapCache . '/*.php') as $file) {
        $dest = $tmpBootstrap . '/' . basename($file);
        if (!file_exists($dest)) {
            copy($file, $dest);
        }
    }
}

// Override the bootstrap cache path via env
putenv('APP_BOOTSTRAP_CACHE=' . $tmpBootstrap);

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

$app->useStoragePath($storagePath);

// ── 3. Point PackageManifest to writable /tmp path ─────────────────────────
$app->bind(\Illuminate\Foundation\PackageManifest::class, function ($app) use ($tmpBootstrap) {
    return new \Illuminate\Foundation\PackageManifest(
        new \Illuminate\Filesystem\Filesystem(),
        $app->basePath(),
        $tmpBootstrap . '/packages.php'
    );
});

return $app;