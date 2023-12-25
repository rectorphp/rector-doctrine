<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Utils\Rector\Rector\YamlToAnnotationsDoctrineMappingRector;

return function (RectorConfig $rectorConfig) {
    $rectorConfig->ruleWithConfiguration(YamlToAnnotationsDoctrineMappingRector::class, [
        __DIR__ . '/yaml_mapping',
    ]);
};
