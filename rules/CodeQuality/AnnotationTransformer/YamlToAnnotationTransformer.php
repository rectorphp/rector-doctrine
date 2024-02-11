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

    public function transform(Class_ $class, EntityMapping $entityMapping): void
    {
        $this->transformClass($class, $entityMapping);

        $this->transformProperties($class, $entityMapping);
    }

    private function transformClass(Class_ $class, EntityMapping $entityMapping): void
    {
        $classPhpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($class);

        foreach ($this->classAnnotationTransformers as $classAnnotationTransformer) {
            // already added
            if ($classPhpDocInfo->hasByAnnotationClass($classAnnotationTransformer->getClassName())) {
                continue;
            }

            $classAnnotationTransformer->transform($entityMapping, $classPhpDocInfo);
        }

        $this->docBlockUpdater->updateRefactoredNodeWithPhpDocInfo($class);
    }

    private function transformProperties(Class_ $class, EntityMapping $entityMapping): void
    {
        foreach ($class->getProperties() as $property) {
            $propertyPhpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);

            foreach ($this->propertyAnnotationTransformers as $propertyAnnotationTransformer) {
                // already added
                if ($propertyPhpDocInfo->hasByAnnotationClass($propertyAnnotationTransformer->getClassName())) {
                    continue;
                }

                $propertyAnnotationTransformer->transform($entityMapping, $propertyPhpDocInfo, $property);
            }

            $this->docBlockUpdater->updateRefactoredNodeWithPhpDocInfo($property);
        }
    }
}
