<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeAnalyzer;

use PhpParser\Node\Attribute;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Property;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;

final class AttrinationFinder
{
    public function __construct(
        private readonly PhpDocInfoFactory $phpDocInfoFactory,
        private readonly AttributeFinder $attributeFinder,
    ) {
    }

    /**
     * @param class-string $name
     */
    public function hasByOne(Property|Class_|ClassMethod|Param $node, string $name): bool
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNode($node);
        if ($phpDocInfo instanceof PhpDocInfo && $phpDocInfo->hasByAnnotationClass($name)) {
            return true;
        }

        $attribute = $this->attributeFinder->findAttributeByClass($node, $name);
        return $attribute instanceof Attribute;
    }

    /**
     * @param class-string[] $names
     */
    public function hasByMany(Property $property, array $names): bool
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNode($property);
        if ($phpDocInfo instanceof PhpDocInfo && $phpDocInfo->hasByAnnotationClasses($names)) {
            return true;
        }

        $attribute = $this->attributeFinder->findAttributeByClasses($property, $names);
        return $attribute instanceof Attribute;
    }
}
