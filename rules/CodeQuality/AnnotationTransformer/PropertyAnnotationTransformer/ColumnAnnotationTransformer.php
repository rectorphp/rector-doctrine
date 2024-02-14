<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\AnnotationTransformer\PropertyAnnotationTransformer;

use PhpParser\Node\Stmt\Property;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\Doctrine\CodeQuality\Contract\PropertyAnnotationTransformerInterface;
use Rector\Doctrine\CodeQuality\DocTagNodeFactory;
use Rector\Doctrine\CodeQuality\Enum\EntityMappingKey;
use Rector\Doctrine\CodeQuality\NodeFactory\ArrayItemNodeFactory;
use Rector\Doctrine\CodeQuality\ValueObject\EntityMapping;
use Rector\Doctrine\Enum\MappingClass;

final readonly class ColumnAnnotationTransformer implements PropertyAnnotationTransformerInterface
{
    public function __construct(
        private ArrayItemNodeFactory $arrayItemNodeFactory
    ) {
    }

    public function transform(EntityMapping $entityMapping, PhpDocInfo $propertyPhpDocInfo, Property $property): void
    {
        $propertyMapping = $entityMapping->matchFieldPropertyMapping($property);
        if ($propertyMapping === null) {
            return;
        }

        // rename to "name"
        if (isset($propertyMapping[EntityMappingKey::COLUMN])) {
            $propertyMapping[EntityMappingKey::NAME] = $propertyMapping[EntityMappingKey::COLUMN];
            unset($propertyMapping[EntityMappingKey::COLUMN]);
        }

        $arrayItemNodes = $this->arrayItemNodeFactory->create(
            $propertyMapping,
            [EntityMappingKey::TYPE, EntityMappingKey::NAME]
        );

        $spacelessPhpDocTagNode = DocTagNodeFactory::createSpacelessPhpDocTagNode(
            $arrayItemNodes,
            $this->getClassName()
        );
        $propertyPhpDocInfo->addPhpDocTagNode($spacelessPhpDocTagNode);
    }

    public function getClassName(): string
    {
        return MappingClass::COLUMN;
    }
}
