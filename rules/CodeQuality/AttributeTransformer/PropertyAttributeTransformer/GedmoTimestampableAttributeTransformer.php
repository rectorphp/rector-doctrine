<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\AttributeTransformer\PropertyAttributeTransformer;

use PhpParser\Node\Param;
use PhpParser\Node\Stmt\Property;
use Rector\Doctrine\CodeQuality\Contract\PropertyAttributeTransformerInterface;
use Rector\Doctrine\CodeQuality\NodeFactory\AttributeFactory;
use Rector\Doctrine\CodeQuality\ValueObject\EntityMapping;
use Rector\Doctrine\Enum\MappingClass;
use Rector\PhpParser\Node\NodeFactory;

final readonly class GedmoTimestampableAttributeTransformer implements PropertyAttributeTransformerInterface
{
    public function __construct(
        private NodeFactory $nodeFactory
    ) {
    }

    public function transform(EntityMapping $entityMapping, Property|Param $property): bool
    {
        $fieldPropertyMapping = $entityMapping->matchFieldPropertyMapping($property);

        $timestampableMapping = $fieldPropertyMapping['gedmo']['timestampable'] ?? null;
        if (! is_array($timestampableMapping)) {
            return false;
        }

        $args = $this->nodeFactory->createArgs($timestampableMapping);
        $property->attrGroups[] = AttributeFactory::createGroup($this->getClassName(), $args);
        return true;
    }

    public function getClassName(): string
    {
        return MappingClass::GEDMO_TIMESTAMPABLE;
    }
}
