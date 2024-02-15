<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\AttributeTransformer;

use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;
use Rector\Doctrine\CodeQuality\Contract\ClassAttributeTransformerInterface;
use Rector\Doctrine\CodeQuality\Contract\PropertyAttributeTransformerInterface;
use Rector\Doctrine\CodeQuality\ValueObject\EntityMapping;

final readonly class YamlToAttributeTransformer
{
    /**
     * @param ClassAttributeTransformerInterface[] $classAttributeTransformers
     * @param PropertyAttributeTransformerInterface[] $propertyAttributeTransformers
     */
    public function __construct(
        private iterable $classAttributeTransformers,
        private iterable $propertyAttributeTransformers,
    ) {
    }

    public function transform(Class_ $class, EntityMapping $entityMapping): void
    {
        $this->transformClass($class, $entityMapping);
        $this->transformProperties($class, $entityMapping);
    }

    private function transformClass(Class_ $class, EntityMapping $entityMapping): void
    {
        foreach ($this->classAttributeTransformers as $classAttributeTransformer) {
            if ($this->hasAttribute($class, $classAttributeTransformer->getClassName())) {
                continue;
            }

            $classAttributeTransformer->transform($entityMapping, $class);
        }
    }

    private function transformProperties(Class_ $class, EntityMapping $entityMapping): void
    {
        foreach ($class->getProperties() as $property) {
            foreach ($this->propertyAttributeTransformers as $propertyAttributeTransformer) {
                if ($this->hasAttribute($property, $propertyAttributeTransformer->getClassName())) {
                    continue;
                }

                $propertyAttributeTransformer->transform($entityMapping, $property);
            }
        }
    }

    private function hasAttribute(Class_|Property $stmt, string $attributeClassName): bool
    {
        foreach ($stmt->attrGroups as $attrGroup) {
            foreach ($attrGroup->attrs as $attr) {
                if ($attr->name->toString() === $attributeClassName) {
                    return true;
                }
            }
        }

        return false;
    }
}
