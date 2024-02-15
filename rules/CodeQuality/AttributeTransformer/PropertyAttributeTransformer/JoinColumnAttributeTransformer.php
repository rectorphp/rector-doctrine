<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\AttributeTransformer\PropertyAttributeTransformer;

use PhpParser\Node\AttributeGroup;
use PhpParser\Node\Stmt\Property;
use Rector\Doctrine\CodeQuality\Contract\PropertyAttributeTransformerInterface;
use Rector\Doctrine\CodeQuality\NodeFactory\AttributeFactory;
use Rector\Doctrine\CodeQuality\ValueObject\EntityMapping;
use Rector\Doctrine\Enum\MappingClass;
use Rector\PhpParser\Node\NodeFactory;

final readonly class JoinColumnAttributeTransformer implements PropertyAttributeTransformerInterface
{
    public function __construct(
        private NodeFactory $nodeFactory
    ) {
    }

    public function transform(EntityMapping $entityMapping, Property $property): void
    {
        $manyToOnePropertyMapping = $entityMapping->matchManyToOnePropertyMapping($property);
        if (! is_array($manyToOnePropertyMapping)) {
            return;
        }

        $joinColumns = $manyToOnePropertyMapping['joinColumns'] ?? null;
        if (! is_array($joinColumns)) {
            return;
        }

        foreach ($joinColumns as $columnName => $joinColumn) {
            $property->attrGroups[] = $this->createJoinColumnAttrGroup($columnName, $joinColumn);
        }
    }

    public function getClassName(): string
    {
        return MappingClass::JOIN_COLUMN;
    }

    private function createJoinColumnAttrGroup(int|string $columnName, mixed $joinColumn): AttributeGroup
    {
        $joinColumn = array_merge([
            'name' => $columnName,
        ], $joinColumn);

        $args = $this->nodeFactory->createArgs($joinColumn);

        return AttributeFactory::createGroup($this->getClassName(), $args);
    }
}
