<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeAnalyzer;

use PhpParser\Node\Attribute;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Property;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;

/**
 * @api
 */
final readonly class AttrinationFinder
{
    public function __construct(
        private PhpDocInfoFactory $phpDocInfoFactory,
        private AttributeFinder $attributeFinder,
    ) {
    }

    public function getByOne(
        Property|Class_|ClassMethod|Param $node,
        string $name
    ): DoctrineAnnotationTagValueNode|Attribute|null {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNode($node);
        if ($phpDocInfo instanceof PhpDocInfo && $phpDocInfo->hasByAnnotationClass($name)) {
            return $phpDocInfo->getByAnnotationClass($name);
        }

        return $this->attributeFinder->findAttributeByClass($node, $name);
    }

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
     * @param string[] $classNames
     */
    public function hasByMany(Class_ | Property $property, array $classNames): bool
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNode($property);
        if ($phpDocInfo instanceof PhpDocInfo && $phpDocInfo->hasByAnnotationClasses($classNames)) {
            return true;
        }

        $attribute = $this->attributeFinder->findAttributeByClasses($property, $classNames);
        return $attribute instanceof Attribute;
    }

    /**
     * @param string[] $classNames
     */
    public function getByMany(
        Class_ | Property $property,
        array $classNames
    ): DoctrineAnnotationTagValueNode|Attribute|null {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNode($property);
        if ($phpDocInfo instanceof PhpDocInfo) {
            $foundDoctrineAnnotationTagValueNode = $phpDocInfo->getByAnnotationClasses($classNames);
            if ($foundDoctrineAnnotationTagValueNode instanceof DoctrineAnnotationTagValueNode) {
                return $foundDoctrineAnnotationTagValueNode;
            }
        }

        return $this->attributeFinder->findAttributeByClasses($property, $classNames);
    }
}
