<?php

declare(strict_types=1);

namespace Rector\Doctrine\TypedCollections\NodeAnalyzer;

use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;
use Rector\Doctrine\Enum\MappingClass;
use Rector\Doctrine\Enum\OdmMappingClass;
use Rector\Doctrine\NodeAnalyzer\AttrinationFinder;

final readonly class EntityLikeClassDetector
{
    public function __construct(
        private AttrinationFinder $attrinationFinder
    ) {
    }

    public function detect(Class_ $class): bool
    {
        return $this->attrinationFinder->hasByMany(
            $class,
            [MappingClass::ENTITY, MappingClass::EMBEDDABLE, OdmMappingClass::DOCUMENT]
        );
    }

    public function isToMany(Property $property): bool
    {
        return $this->attrinationFinder->hasByMany(
            $property,
            [MappingClass::ONE_TO_MANY, MappingClass::MANY_TO_MANY, OdmMappingClass::REFERENCE_MANY]
        );
    }
}
