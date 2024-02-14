<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\AnnotationTransformer;

use PhpParser\Node\Stmt\Class_;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Comments\NodeDocBlock\DocBlockUpdater;
use Rector\Doctrine\CodeQuality\Contract\ClassAnnotationTransformerInterface;
use Rector\Doctrine\CodeQuality\Contract\PropertyAnnotationTransformerInterface;
use Rector\Doctrine\CodeQuality\ValueObject\EntityMapping;

final readonly class YamlToAnnotationTransformer
{
    /**
     * @param ClassAnnotationTransformerInterface[] $classAnnotationTransformers
     * @param PropertyAnnotationTransformerInterface[] $propertyAnnotationTransformers
     */
    public function __construct(
        private iterable $classAnnotationTransformers,
        private iterable $propertyAnnotationTransformers,
        private PhpDocInfoFactory $phpDocInfoFactory,
        private DocBlockUpdater $docBlockUpdater,
    ) {
    }

    public function transform(Class_ $class, EntityMapping $entityMapping): bool
    {
        $hasChanged = $this->transformClass($class, $entityMapping);

        $hasChangedProperties = $this->transformProperties($class, $entityMapping);

        return $hasChanged || $hasChangedProperties;
    }

    private function transformClass(Class_ $class, EntityMapping $entityMapping): bool
    {
        $classPhpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($class);

        $hasChanged = false;
        foreach ($this->classAnnotationTransformers as $classAnnotationTransformer) {
            // already added
            if ($classPhpDocInfo->hasByAnnotationClass($classAnnotationTransformer->getClassName())) {
                continue;
            }

            $classAnnotationTransformer->transform($entityMapping, $classPhpDocInfo);
            $hasChanged = true;
        }

        if ($hasChanged) {
            $this->docBlockUpdater->updateRefactoredNodeWithPhpDocInfo($class);
        }

        return $hasChanged;
    }

    private function transformProperties(Class_ $class, EntityMapping $entityMapping): bool
    {
        $hasChanged = false;
        foreach ($class->getProperties() as $property) {
            $propertyPhpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);

            foreach ($this->propertyAnnotationTransformers as $propertyAnnotationTransformer) {
                // already added
                if ($propertyPhpDocInfo->hasByAnnotationClass($propertyAnnotationTransformer->getClassName())) {
                    continue;
                }

                $propertyAnnotationTransformer->transform($entityMapping, $propertyPhpDocInfo, $property);
                $hasChanged = true;
            }

            if ($hasChanged) {
                $this->docBlockUpdater->updateRefactoredNodeWithPhpDocInfo($property);
            }
        }

        return $hasChanged;
    }
}
