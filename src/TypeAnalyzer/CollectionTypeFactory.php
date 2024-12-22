<?php

declare(strict_types=1);

namespace Rector\Doctrine\TypeAnalyzer;

use PhpParser\Node\Param;
use PhpParser\Node\Stmt\Property;
use PHPStan\Type\Generic\GenericObjectType;
use PHPStan\Type\IntegerType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\StringType;
use Rector\PhpParser\AstResolver;

final readonly class CollectionTypeFactory
{
    public function __construct(
        private AstResolver $astResolver
    ) {
    }

    public function createType(ObjectType $objectType, bool $withIndexBy, Property|Param $property): GenericObjectType
    {
        $keyType = new IntegerType();

        if ($withIndexBy) {
            $keyType = $this->resolveKeyType($property, $objectType->getClassName());
        }

        $genericTypes = [$keyType, $objectType];

        return new GenericObjectType('Doctrine\Common\Collections\Collection', $genericTypes);
    }

    private function resolveKeyType(Property|Param $property, string $className): IntegerType|StringType
    {
        // todo, resolve type from annotation/attribute
        //    -> use AstResolver to get target Class
        //         -> get property type from it
        //             -> resolve from its annotation/attribute
        // fallback to IntegerType
        return new IntegerType();
    }
}
