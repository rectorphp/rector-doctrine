<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector;

return RectorConfig::configure()
    ->withConfiguredRule(YamlToAnnotationsDoctrineMappingRector::class, [__DIR__ . '/yaml_mapping']);
