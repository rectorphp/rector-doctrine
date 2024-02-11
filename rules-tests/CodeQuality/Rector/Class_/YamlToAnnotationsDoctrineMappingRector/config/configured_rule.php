<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector;
use Rector\Doctrine\Set\DoctrineSetList;

return function (RectorConfig $rectorConfig) {
    $rectorConfig->ruleWithConfiguration(YamlToAnnotationsDoctrineMappingRector::class, [
        __DIR__ . '/yaml_mapping',
    ]);

    $rectorConfig->sets([DoctrineSetList::YAML_TO_ANNOTATIONS]);
};
