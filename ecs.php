<?php

declare(strict_types=1);

use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
    ->withPreparedSets(psr12: true, common: true, cleanCode: true, symplify: true)
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/rules',
        __DIR__ . '/rules-tests',
        __DIR__ . '/tests',
        __DIR__ . '/config',
    ])
    ->withRootFiles()
    ->withSkip(['*/Source/*', '*/Fixture/*']);
