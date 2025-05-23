<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\CodeQuality\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector;
use Rector\Doctrine\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector;
use Rector\Doctrine\CodeQuality\Rector\Property\TypedPropertyFromToManyRelationTypeRector;
use Rector\Doctrine\TypedCollections\Rector\Class_\ExplicitRelationCollectionRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rules([
        ExplicitRelationCollectionRector::class,
        AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector::class,
        TypedPropertyFromToManyRelationTypeRector::class,
        ImproveDoctrineCollectionDocTypeInEntityRector::class,
    ]);
};
