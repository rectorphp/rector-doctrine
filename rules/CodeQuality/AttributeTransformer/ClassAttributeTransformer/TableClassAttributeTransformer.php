<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\AttributeTransformer\ClassAttributeTransformer;

use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\Class_;
use Rector\Doctrine\CodeQuality\Contract\ClassAttributeTransformerInterface;
use Rector\Doctrine\CodeQuality\NodeFactory\AttributeFactory;
use Rector\Doctrine\CodeQuality\ValueObject\EntityMapping;
use Rector\Doctrine\Enum\MappingClass;
use Rector\PhpParser\Node\NodeFactory;

final readonly class TableClassAttributeTransformer implements ClassAttributeTransformerInterface
{
    /**
     * @var string
     */
    private const TABLE_KEY = 'table';

    public function __construct(
        private NodeFactory $nodeFactory
    ) {
    }

    public function transform(EntityMapping $entityMapping, Class_ $class): void
    {
        $classMapping = $entityMapping->getClassMapping();

        $table = $classMapping[self::TABLE_KEY] ?? null;
        if (isset($classMapping['type']) && $classMapping['type'] !== 'entity') {
            return;
        }

        $args = [];
        if (is_string($table)) {
            $args[] = AttributeFactory::createNamedArg(new String_($table), 'name');
        }

        $class->attrGroups[] = AttributeFactory::createGroup($this->getClassName(), $args);

        $this->addIndexes($classMapping['indexes'] ?? [], $class, MappingClass::INDEX);
        $this->addIndexes($classMapping['uniqueConstraints'] ?? [], $class, MappingClass::UNIQUE_CONSTRAINT);
    }

    /**
     * @param array<string, array<string, mixed>> $mapping
     * @param MappingClass::* $attribute
     */
    private function addIndexes(array $mapping, Class_ $class, string $attribute): void
    {
        foreach ($mapping as $name => $values) {
            $values = array_merge([
                'name' => $name,
            ], $values);

            $args = $this->nodeFactory->createArgs($values);
            $class->attrGroups[] = AttributeFactory::createGroup($attribute, $args);
        }
    }

    public function getClassName(): string
    {
        return MappingClass::TABLE;
    }
}
