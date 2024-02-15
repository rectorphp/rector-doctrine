<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\AttributeTransformer;

use PhpParser\Node\Stmt\Class_;
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
            $classAttributeTransformer->transform($entityMapping, $class);
        }
    }

    private function transformProperties(Class_ $class, EntityMapping $entityMapping): void
    {
        foreach ($class->getProperties() as $property) {
            foreach ($this->propertyAttributeTransformers as $propertyAttributeTransformer) {
                $propertyAttributeTransformer->transform($entityMapping, $property);
            }
        }
    }
}
