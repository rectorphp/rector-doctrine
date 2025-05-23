<?php

declare(strict_types=1);

namespace Rector\Doctrine\PhpDocParser;

use PhpParser\Node\Stmt\Class_;
use Rector\Doctrine\Enum\MappingClass;
use Rector\Doctrine\Enum\OdmMappingClass;
use Rector\Doctrine\NodeAnalyzer\AttrinationFinder;

/**
 * @api
 * @deprecated Use \Rector\Doctrine\TypedCollections\NodeAnalyzer\EntityLikeClassDetector instead
 */
final readonly class DoctrineDocBlockResolver
{
    public function __construct(
        private AttrinationFinder $attrinationFinder,
    ) {
    }

    /**
     * @deprecated Use \Rector\Doctrine\TypedCollections\NodeAnalyzer\EntityLikeClassDetector::detect() instead
     */
    public function isDoctrineEntityClass(Class_ $class): bool
    {
        return $this->attrinationFinder->hasByMany($class, [
            MappingClass::ENTITY, MappingClass::EMBEDDABLE, OdmMappingClass::DOCUMENT,
        ]);
    }
}
