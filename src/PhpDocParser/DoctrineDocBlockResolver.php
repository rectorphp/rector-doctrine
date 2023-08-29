<?php

declare(strict_types=1);

namespace Rector\Doctrine\PhpDocParser;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Embeddable;
use PhpParser\Node\Stmt\Class_;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;

final class DoctrineDocBlockResolver
{
    public function __construct(
        private readonly PhpDocInfoFactory $phpDocInfoFactory
    ) {
    }

    public function isDoctrineEntityClass(Class_ $class): bool
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($class);
        return $phpDocInfo->hasByAnnotationClasses([Entity::class, Embeddable::class]);
    }
}
