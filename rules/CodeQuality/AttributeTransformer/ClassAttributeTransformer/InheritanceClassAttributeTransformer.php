<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\AttributeTransformer\ClassAttributeTransformer;

use PhpParser\Node\Stmt\Class_;
use Rector\Doctrine\CodeQuality\Contract\ClassAttributeTransformerInterface;
use Rector\Doctrine\CodeQuality\NodeFactory\AttributeFactory;
use Rector\Doctrine\CodeQuality\ValueObject\EntityMapping;
use Rector\Doctrine\Enum\MappingClass;
use Rector\PhpParser\Node\NodeFactory;

final readonly class InheritanceClassAttributeTransformer implements ClassAttributeTransformerInterface
{
    public function __construct(
        private NodeFactory $nodeFactory
    ) {
    }

    public function transform(EntityMapping $entityMapping, Class_ $class): void
    {
        $classMapping = $entityMapping->getClassMapping();

        $inheritanceType = $classMapping['inheritanceType'] ?? null;
        if ($inheritanceType === null) {
            return;
        }

        $args = $this->nodeFactory->createArgs([
            'type' => $inheritanceType,
        ]);
        $class->attrGroups[] = AttributeFactory::createGroup(MappingClass::INHERITANCE_TYPE, $args);

        if (isset($classMapping['discriminatorColumn'])) {
            $this->addDisriminatorColumn($classMapping['discriminatorColumn'], $class);
        }

        if (isset($classMapping['discriminatorMap'])) {
            $this->addDiscriminatorMap($classMapping['discriminatorMap'], $class);
        }
    }

    public function getClassName(): string
    {
        return MappingClass::DISCRIMINATOR_MAP;
    }

    /**
     * @param array<string, mixed> $discriminatorColumn
     */
    private function addDisriminatorColumn(array $discriminatorColumn, Class_ $class): void
    {
        $args = $this->nodeFactory->createArgs($discriminatorColumn);
        $class->attrGroups[] = AttributeFactory::createGroup(MappingClass::DISCRIMINATOR_COLUMN, $args);
    }

    /**
     * @param array<string, mixed> $discriminatorMap
     */
    private function addDiscriminatorMap(array $discriminatorMap, Class_ $class): void
    {
        $args = $this->nodeFactory->createArgs($discriminatorMap);

        // @todo all value should be class const
        $class->attrGroups[] = AttributeFactory::createGroup(MappingClass::DISCRIMINATOR_MAP, $args);
    }
}
