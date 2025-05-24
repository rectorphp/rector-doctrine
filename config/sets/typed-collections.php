<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rules([
        \Rector\Doctrine\TypedCollections\Rector\Assign\ArrayDimFetchAssignToAddCollectionCallRector::class,
        \Rector\Doctrine\TypedCollections\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector::class,
        \Rector\Doctrine\TypedCollections\Rector\Class_\DefaultNewArrayCollectionRector::class,
        \Rector\Doctrine\TypedCollections\Rector\Class_\InitializeCollectionInConstructorRector::class,
        \Rector\Doctrine\TypedCollections\Rector\ClassMethod\CollectionGetterNativeTypeRector::class,
        \Rector\Doctrine\TypedCollections\Rector\ClassMethod\CollectionParamTypeSetterToCollectionPropertyRector::class,
        \Rector\Doctrine\TypedCollections\Rector\ClassMethod\DefaultCollectionKeyRector::class,
        \Rector\Doctrine\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector::class,
        \Rector\Doctrine\TypedCollections\Rector\ClassMethod\NarrowParamUnionToCollectionRector::class,
        \Rector\Doctrine\TypedCollections\Rector\ClassMethod\NarrowReturnUnionToCollectionRector::class,
        \Rector\Doctrine\TypedCollections\Rector\ClassMethod\RemoveNewArrayCollectionOutsideConstructorRector::class,
        \Rector\Doctrine\TypedCollections\Rector\ClassMethod\ReturnArrayToNewArrayCollectionRector::class,
        \Rector\Doctrine\TypedCollections\Rector\ClassMethod\ReturnCollectionDocblockRector::class,
        \Rector\Doctrine\TypedCollections\Rector\Empty_\EmptyOnCollectionToIsEmptyCallRector::class,
        \Rector\Doctrine\TypedCollections\Rector\Expression\RemoveCoalesceAssignOnCollectionRector::class,
        \Rector\Doctrine\TypedCollections\Rector\FuncCall\ArrayMapOnCollectionToArrayRector::class,
        \Rector\Doctrine\TypedCollections\Rector\FuncCall\ArrayMergeOnCollectionToArrayRector::class,
        \Rector\Doctrine\TypedCollections\Rector\FuncCall\InArrayOnCollectionToContainsCallRector::class,
        \Rector\Doctrine\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector::class,
        \Rector\Doctrine\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector::class,
        \Rector\Doctrine\TypedCollections\Rector\New_\RemoveNewArrayCollectionWrapRector::class,
        \Rector\Doctrine\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector::class,
        \Rector\Doctrine\TypedCollections\Rector\Property\NarrowPropertyUnionToCollectionRector::class,
        \Rector\Doctrine\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector::class,

    ]);
};
