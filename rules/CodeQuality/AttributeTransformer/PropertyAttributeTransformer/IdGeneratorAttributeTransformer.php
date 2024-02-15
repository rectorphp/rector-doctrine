<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\AttributeTransformer\PropertyAttributeTransformer;

use PhpParser\Node\Param;
use PhpParser\Node\Stmt\Property;
use Rector\Doctrine\CodeQuality\Contract\PropertyAttributeTransformerInterface;
use Rector\Doctrine\CodeQuality\Enum\EntityMappingKey;
use Rector\Doctrine\CodeQuality\NodeFactory\AttributeFactory;
use Rector\Doctrine\CodeQuality\ValueObject\EntityMapping;
use Rector\Doctrine\Enum\MappingClass;
use Rector\PhpParser\Node\NodeFactory;

final readonly class IdGeneratorAttributeTransformer implements PropertyAttributeTransformerInterface
{
    /**
     * @see https://www.doctrine-project.org/projects/doctrine-orm/en/3.0/reference/basic-mapping.html#identifier-generation-strategies
     * @var string[]
     */
    private const AVAILABLE_STRATEGIES = ['auto', 'sequence', 'identity', 'none', 'custom'];

    public function __construct(
        //        private ArrayItemNodeFactory $arrayItemNodeFactory
        private NodeFactory $nodeFactory
    ) {
    }

    public function transform(EntityMapping $entityMapping, Property|Param $property): void
    {
        $idMapping = $entityMapping->matchIdPropertyMapping($property);
        if (! is_array($idMapping)) {
            return;
        }

        $generator = $idMapping[EntityMappingKey::GENERATOR] ?? null;
        if (! is_array($generator)) {
            return;
        }

        // make sure strategy is uppercase as constant value
        $generator = $this->normalizeStrategy($generator);

        $args = $this->nodeFactory->createArgs($generator);
        $property->attrGroups[] = AttributeFactory::createGroup($this->getClassName(), $args);
    }

    public function getClassName(): string
    {
        return MappingClass::GENERATED_VALUE;
    }

    /**
     * @param array<string, mixed> $generator
     * @return array<string, mixed>
     */
    private function normalizeStrategy(array $generator): array
    {
        if (isset($generator[EntityMappingKey::STRATEGY]) && in_array(
            $generator[EntityMappingKey::STRATEGY],
            self::AVAILABLE_STRATEGIES,
            true
        )) {
            $generator[EntityMappingKey::STRATEGY] = strtoupper($generator[EntityMappingKey::STRATEGY]);
        }

        return $generator;
    }
}
