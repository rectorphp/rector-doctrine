<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\AttributeTransformer\PropertyAttributeTransformer;

use PhpParser\Node\Param;
use PhpParser\Node\Stmt\Property;
use Rector\Doctrine\CodeQuality\Contract\PropertyAttributeTransformerInterface;
use Rector\Doctrine\CodeQuality\Enum\EntityMappingKey;
use Rector\Doctrine\CodeQuality\Helper\NodeValueNormalizer;
use Rector\Doctrine\CodeQuality\NodeFactory\AttributeFactory;
use Rector\Doctrine\CodeQuality\ValueObject\EntityMapping;
use Rector\Doctrine\Enum\MappingClass;
use Rector\PhpParser\Node\NodeFactory;

final readonly class ManyToOneAttributeTransformer implements PropertyAttributeTransformerInterface
{
    public function __construct(
        private NodeFactory $nodeFactory
    ) {
    }

    public function transform(EntityMapping $entityMapping, Property|Param $property): bool
    {
        $manyToOneMapping = $entityMapping->matchManyToOnePropertyMapping($property);
        if (! is_array($manyToOneMapping)) {
            return false;
        }

        // handled by another mapper
        unset($manyToOneMapping['joinColumn'], $manyToOneMapping['joinColumns']);

        // non existing
        unset($manyToOneMapping['nullable']);

        $args = $this->nodeFactory->createArgs($manyToOneMapping);
        $property->attrGroups[] = AttributeFactory::createGroup($this->getClassName(), $args);

        NodeValueNormalizer::ensureKeyIsClassConstFetch($args, EntityMappingKey::TARGET_ENTITY);
        return true;
    }

    public function getClassName(): string
    {
        return MappingClass::MANY_TO_ONE;
    }
}
