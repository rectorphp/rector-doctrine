<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\TypedCollections\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector;
use Rector\Doctrine\TypedCollections\Rector\Class_\InitializeCollectionInConstructorRector;
use Rector\Doctrine\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector;
use Rector\Doctrine\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rules([
        // native types
        InitializeCollectionInConstructorRector::class,
        TypedPropertyFromToManyRelationTypeRector::class,

        // docblock types
        AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector::class,
        ImproveDoctrineCollectionDocTypeInEntityRector::class,
    ]);
};
