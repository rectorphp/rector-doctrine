<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector;

return RectorConfig::configure()
    ->withConfiguredRule(YamlToAttributeDoctrineMappingRector::class, [__DIR__ . '/yaml_mapping']);
