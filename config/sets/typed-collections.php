<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\TypedCollections\Rector\Assign\ArrayDimFetchAssignToAddCollectionCallRector;
use Rector\Doctrine\TypedCollections\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector;
use Rector\Doctrine\TypedCollections\Rector\Class_\DefaultNewArrayCollectionRector;
use Rector\Doctrine\TypedCollections\Rector\Class_\InitializeCollectionInConstructorRector;
use Rector\Doctrine\TypedCollections\Rector\ClassMethod\CollectionGetterNativeTypeRector;
use Rector\Doctrine\TypedCollections\Rector\ClassMethod\CollectionParamTypeSetterToCollectionPropertyRector;
use Rector\Doctrine\TypedCollections\Rector\ClassMethod\DefaultCollectionKeyRector;
use Rector\Doctrine\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector;
use Rector\Doctrine\TypedCollections\Rector\ClassMethod\NarrowParamUnionToCollectionRector;
use Rector\Doctrine\TypedCollections\Rector\ClassMethod\NarrowReturnUnionToCollectionRector;
use Rector\Doctrine\TypedCollections\Rector\ClassMethod\RemoveNewArrayCollectionOutsideConstructorRector;
use Rector\Doctrine\TypedCollections\Rector\ClassMethod\ReturnArrayToNewArrayCollectionRector;
use Rector\Doctrine\TypedCollections\Rector\ClassMethod\ReturnCollectionDocblockRector;
use Rector\Doctrine\TypedCollections\Rector\Empty_\EmptyOnCollectionToIsEmptyCallRector;
use Rector\Doctrine\TypedCollections\Rector\Expression\RemoveCoalesceAssignOnCollectionRector;
use Rector\Doctrine\TypedCollections\Rector\FuncCall\ArrayMapOnCollectionToArrayRector;
use Rector\Doctrine\TypedCollections\Rector\FuncCall\ArrayMergeOnCollectionToArrayRector;
use Rector\Doctrine\TypedCollections\Rector\FuncCall\InArrayOnCollectionToContainsCallRector;
use Rector\Doctrine\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector;
use Rector\Doctrine\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector;
use Rector\Doctrine\TypedCollections\Rector\New_\RemoveNewArrayCollectionWrapRector;
use Rector\Doctrine\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector;
use Rector\Doctrine\TypedCollections\Rector\Property\NarrowPropertyUnionToCollectionRector;
use Rector\Doctrine\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rules([
        ArrayDimFetchAssignToAddCollectionCallRector::class,
        AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector::class,
        DefaultNewArrayCollectionRector::class,
        InitializeCollectionInConstructorRector::class,
        CollectionGetterNativeTypeRector::class,
        CollectionParamTypeSetterToCollectionPropertyRector::class,
        DefaultCollectionKeyRector::class,
        NarrowArrayCollectionToCollectionRector::class,
        NarrowParamUnionToCollectionRector::class,
        NarrowReturnUnionToCollectionRector::class,
        RemoveNewArrayCollectionOutsideConstructorRector::class,
        ReturnArrayToNewArrayCollectionRector::class,
        ReturnCollectionDocblockRector::class,
        EmptyOnCollectionToIsEmptyCallRector::class,
        RemoveCoalesceAssignOnCollectionRector::class,
        ArrayMapOnCollectionToArrayRector::class,
        ArrayMergeOnCollectionToArrayRector::class,
        InArrayOnCollectionToContainsCallRector::class,
        RemoveIfInstanceofCollectionRector::class,
        SetArrayToNewCollectionRector::class,
        RemoveNewArrayCollectionWrapRector::class,
        ImproveDoctrineCollectionDocTypeInEntityRector::class,
        NarrowPropertyUnionToCollectionRector::class,
        TypedPropertyFromToManyRelationTypeRector::class,

    ]);
};
