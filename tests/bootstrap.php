<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

// autoload rector first, but with local paths
// build preload file to autoload local php-parser instead of phpstan one, e.g. in case of early upgrade
$preloadPath = __DIR__ . '/../';
exec(PHP_BINARY . ' vendor/rector/rector-src/build/build-preload.php ' . $preloadPath);
sleep(3);

require __DIR__ . '/../preload.php';

unlink(__DIR__ . '/../preload.php');
