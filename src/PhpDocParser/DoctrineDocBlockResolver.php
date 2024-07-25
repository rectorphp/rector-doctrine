<?php

declare(strict_types=1);

namespace Rector\Doctrine\PhpDocParser;

use PhpParser\Node\Stmt\Class_;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Doctrine\Enum\MappingClass;
use Rector\Doctrine\Enum\OdmMappingClass;

final readonly class DoctrineDocBlockResolver
{
    public function __construct(
        private PhpDocInfoFactory $phpDocInfoFactory
    ) {
    }

    public function isDoctrineEntityClass(Class_ $class): bool
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($class);

        return $phpDocInfo->hasByAnnotationClasses(
            [MappingClass::ENTITY, MappingClass::EMBEDDABLE, OdmMappingClass::DOCUMENT]
        );
    }
}
