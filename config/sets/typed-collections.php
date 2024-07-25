<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\CodeQuality\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector;
use Rector\Doctrine\CodeQuality\Rector\Class_\ExplicitRelationCollectionRector;

return RectorConfig::configure()
    ->withRules([
        ExplicitRelationCollectionRector::class,
        AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector::class,
    ]);
