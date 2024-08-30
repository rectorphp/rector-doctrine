<?php

declare(strict_types=1);

namespace Rector\Doctrine\TypeAnalyzer;

use PHPStan\Type\Generic\GenericObjectType;
use PHPStan\Type\IntegerType;
use PHPStan\Type\IntersectionType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;

final class CollectionTypeFactory
{
    public function createType(ObjectType $objectType, bool $addSelectableUnion = false): Type
    {
        $genericTypes = [new IntegerType(), $objectType];
        $collectionType = new GenericObjectType('Doctrine\Common\Collections\Collection', $genericTypes);
        if (!$addSelectableUnion) {
            return $collectionType;
        }

        $selectableType = new GenericObjectType('Doctrine\Common\Collections\Selectable', $genericTypes);
        return new IntersectionType([$collectionType, $selectableType]);
    }
}
