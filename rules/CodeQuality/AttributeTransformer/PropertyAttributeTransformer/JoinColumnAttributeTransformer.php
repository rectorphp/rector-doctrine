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

final readonly class JoinColumnAttributeTransformer implements PropertyAttributeTransformerInterface
{
    public function __construct(
        private NodeFactory $nodeFactory
    ) {
    }

    public function transform(EntityMapping $entityMapping, Property|Param $property): void
    {
        $this->transformMapping(
            $property,
            $entityMapping->matchManyToManyPropertyMapping($property)['joinTable'] ?? null
        );
        $this->transformMapping($property, $entityMapping->matchManyToOnePropertyMapping($property));
    }

    public function getClassName(): string
    {
        return MappingClass::JOIN_COLUMN;
    }

    /**
     * @param array<string, array<string, mixed>>|null $mapping
     */
    private function transformMapping(Property|Param $property, ?array $mapping): void
    {
        if (! is_array($mapping)) {
            return;
        }

        $singleJoinColumn = $mapping['joinColumn'] ?? null;
        if (is_array($singleJoinColumn)) {
            $name = $singleJoinColumn['name'];
            unset($singleJoinColumn['name']);
            $mapping['joinColumns'][$name] = $singleJoinColumn;
        }

        $joinColumns = $mapping['joinColumns'] ?? null;
        if (! is_array($joinColumns)) {
            return;
        }

        foreach ($joinColumns as $columnName => $joinColumn) {
            $property->attrGroups[] = $this->createJoinColumnAttrGroup($columnName, $joinColumn);
        }
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
