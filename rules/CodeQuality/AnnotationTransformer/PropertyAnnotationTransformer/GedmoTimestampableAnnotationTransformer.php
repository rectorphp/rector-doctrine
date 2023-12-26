<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\AnnotationTransformer\PropertyAnnotationTransformer;

use PhpParser\Node\Stmt\Property;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\Doctrine\CodeQuality\Contract\PropertyAnnotationTransformerInterface;
use Rector\Doctrine\CodeQuality\DocTagNodeFactory;
use Rector\Doctrine\CodeQuality\NodeFactory\ArrayItemNodeFactory;
use Rector\Doctrine\CodeQuality\ValueObject\EntityMapping;

final class GedmoTimestampableAnnotationTransformer implements PropertyAnnotationTransformerInterface
{
    public function __construct(
        private readonly ArrayItemNodeFactory $arrayItemNodeFactory
    ) {
    }

    public function transform(EntityMapping $entityMapping, PhpDocInfo $propertyPhpDocInfo, Property $property): void
    {
        $fieldPropertyMapping = $entityMapping->matchFieldPropertyMapping($property);

        $timestampableMapping = $fieldPropertyMapping['gedmo']['timestampable'] ?? null;
        if (! is_array($timestampableMapping)) {
            return;
        }

        $arrayItemNodes = $this->arrayItemNodeFactory->create($timestampableMapping, ['on']);
        $spacelessPhpDocTagNode = DocTagNodeFactory::createSpacelessPhpDocTagNode(
            $arrayItemNodes,
            $this->getClassName()
        );

        $propertyPhpDocInfo->addPhpDocTagNode($spacelessPhpDocTagNode);
    }

    public function getClassName(): string
    {
        return 'Gedmo\Mapping\Annotation\Timestampable';
    }
}
