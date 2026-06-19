<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// ── 1. Create writable runtime dirs in /tmp ─────────────────────────────────
// Storage (logs, sessions, view cache, file cache) must be writable at
// runtime, so it lives in /tmp. bootstrap/cache, by contrast, should be
// PRE-BUILT at deploy time and shipped read-only — see deployment notes.
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

// ── Alternative: if pre-baking bootstrap/cache isn't possible, use the
// official then() hook to redirect the bootstrap cache path BEFORE the app
// boots and registers providers. Uncomment if needed:
//
// $tmpBootstrap = '/tmp/bootstrap-cache';
// is_dir($tmpBootstrap) || mkdir($tmpBootstrap, 0755, true);
// foreach (glob(__DIR__ . '/cache/*.php') as $file) {
//     $dest = $tmpBootstrap . '/' . basename($file);
//     file_exists($dest) || copy($file, $dest);
// }

$app = Application::configure(basePath: dirname(__DIR__))
    // ->then(function (Application $app) use ($tmpBootstrap) {
    //     $app->useBootstrapPath($tmpBootstrap);
    // })
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
    })
    ->create();

$app->useStoragePath($storagePath);

return $app;