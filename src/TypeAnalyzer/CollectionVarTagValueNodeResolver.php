<?php

declare(strict_types=1);

namespace Rector\Doctrine\TypeAnalyzer;

use PhpParser\Node\Stmt\Property;
use PHPStan\PhpDocParser\Ast\PhpDoc\VarTagValueNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Doctrine\CodeQuality\Enum\CollectionMapping;
use Rector\Doctrine\NodeAnalyzer\AttributeFinder;

final readonly class CollectionVarTagValueNodeResolver
{
    public function __construct(
        private PhpDocInfoFactory $phpDocInfoFactory,
        private AttributeFinder $attributeFinder,
    ) {
    }

    public function resolve(Property $property): ?VarTagValueNode
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);
        if (! $this->hasAnnotationOrAttributeToMany($phpDocInfo, $property)) {
            return null;
        }

        return $phpDocInfo->getVarTagValueNode();
    }

    private function hasAnnotationOrAttributeToMany(PhpDocInfo $phpDocInfo, Property $property): bool
    {
        if ($phpDocInfo->hasByAnnotationClasses(CollectionMapping::TO_MANY_CLASSES)) {
            return true;
        }

        return $this->attributeFinder->hasAttributeByClasses($property, CollectionMapping::TO_MANY_CLASSES);
    }
}
