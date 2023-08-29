<?php

declare(strict_types=1);

namespace Rector\Doctrine\TypeAnalyzer;

use Doctrine\ORM\Mapping\OneToMany;
use PhpParser\Node\Stmt\Property;
use PHPStan\PhpDocParser\Ast\PhpDoc\VarTagValueNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;

final class CollectionVarTagValueNodeResolver
{
    public function __construct(
        private readonly PhpDocInfoFactory $phpDocInfoFactory
    ) {
    }

    public function resolve(Property $property): ?VarTagValueNode
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);
        if (! $phpDocInfo->hasByAnnotationClass(OneToMany::class)) {
            return null;
        }

        return $phpDocInfo->getVarTagValueNode();
    }
}
