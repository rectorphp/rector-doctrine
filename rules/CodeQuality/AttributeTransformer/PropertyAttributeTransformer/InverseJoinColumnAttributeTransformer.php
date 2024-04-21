<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\AttributeTransformer\PropertyAttributeTransformer;

use PhpParser\Node\AttributeGroup;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt\Property;
use Rector\Doctrine\CodeQuality\Contract\PropertyAttributeTransformerInterface;
use Rector\Doctrine\CodeQuality\NodeFactory\AttributeFactory;
use Rector\Doctrine\CodeQuality\ValueObject\EntityMapping;
use Rector\Doctrine\Enum\MappingClass;
use Rector\PhpParser\Node\NodeFactory;

final readonly class InverseJoinColumnAttributeTransformer implements PropertyAttributeTransformerInterface
{
    public function __construct(
        private NodeFactory $nodeFactory
    ) {
    }

    public function transform(EntityMapping $entityMapping, Property|Param $property): void
    {
        $joinTableMapping = $entityMapping->matchManyToManyPropertyMapping($property)['joinTable'] ?? null;
        if (! is_array($joinTableMapping)) {
            return;
        }

        $joinColumns = $joinTableMapping['inverseJoinColumns'] ?? null;
        if (! is_array($joinColumns)) {
            return;
        }

        foreach ($joinColumns as $columnName => $joinColumn) {
            $property->attrGroups[] = $this->createInverseJoinColumnAttrGroup($columnName, $joinColumn);
        }
    }

    public function getClassName(): string
    {
        return MappingClass::INVERSE_JOIN_COLUMN;
    }

    private function createInverseJoinColumnAttrGroup(int|string $columnName, mixed $joinColumn): AttributeGroup
    {
        $joinColumn = array_merge([
            'name' => $columnName,
        ], $joinColumn);

        $args = $this->nodeFactory->createArgs($joinColumn);

        return AttributeFactory::createGroup($this->getClassName(), $args);
    }
}
