<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\AttributeTransformer\PropertyAttributeTransformer;

use PhpParser\Node\Stmt\Property;
use Rector\Doctrine\CodeQuality\Contract\PropertyAttributeTransformerInterface;
use Rector\Doctrine\CodeQuality\Enum\EntityMappingKey;
use Rector\Doctrine\CodeQuality\NodeFactory\AttributeFactory;
use Rector\Doctrine\CodeQuality\ValueObject\EntityMapping;
use Rector\Doctrine\Enum\MappingClass;
use Rector\PhpParser\Node\NodeFactory;

final readonly class OrderByAttributeTransformer implements PropertyAttributeTransformerInterface
{
    public function __construct(
        private NodeFactory $nodeFactory,
    ) {
    }

    public function transform(EntityMapping $entityMapping, Property $property): void
    {
        $oneToManyMapping = $entityMapping->matchOneToManyPropertyMapping($property);
        if (! is_array($oneToManyMapping)) {
            return;
        }

        // we handle OrderBy here only
        if (! isset($oneToManyMapping[EntityMappingKey::ORDER_BY])) {
            return;
        }

        $orderBy = $oneToManyMapping[EntityMappingKey::ORDER_BY];
        $args = $this->nodeFactory->createArgs([$orderBy]);

        $property->attrGroups[] = AttributeFactory::createGroup($this->getClassName(), $args);
    }

    public function getClassName(): string
    {
        return MappingClass::ORDER_BY;
    }
}
