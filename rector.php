<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Php55\Rector\String_\StringClassNameToClassConstantRector;

return RectorConfig::configure()
    ->withImportNames(removeUnusedImports: true)
    ->withPaths([__DIR__ . '/src', __DIR__ . '/rules', __DIR__ . '/tests'])
    ->withSkip(['*/Source/*', '*/Fixture/*'])
    ->withRootFiles()
    ->withPhpSets()
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle: true,
        naming: true,
        typeDeclarations: true,
        privatization: true,
        rectorPreset: true
    )
    ->withConfiguredRule(StringClassNameToClassConstantRector::class, [
        'Doctrine\*',
        'Gedmo\*',
        'Knp\*',
        'DateTime',
        'DateTimeInterface',
    ]);
