<?php

declare(strict_types=1);

namespace Rector\Doctrine\TypedCollections\NodeAnalyzer;

use PhpParser\Node\Stmt\Class_;
use Rector\Doctrine\Enum\MappingClass;
use Rector\Doctrine\Enum\OdmMappingClass;
use Rector\Doctrine\NodeAnalyzer\AttrinationFinder;

final class EntityLikeClassDetector
{
    public function __construct(
        private readonly AttrinationFinder $attrinationFinder
    ) {
    }

    public function detect(Class_ $class): bool
    {
        return $this->attrinationFinder->hasByMany(
            $class,
            [MappingClass::ENTITY, MappingClass::EMBEDDABLE, OdmMappingClass::DOCUMENT]
        );
    }
}
