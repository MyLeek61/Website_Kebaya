<?php
putenv('VIEW_COMPILED_PATH=/tmp');
require __DIR__ . '/../public/index.php';
if (getenv('IS_VERCEL')) {
    putenv('APP_STORAGE=/tmp');
}