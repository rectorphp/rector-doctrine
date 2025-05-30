<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\AttributeTransformer\PropertyAttributeTransformer;

use PhpParser\Node\Param;
use PhpParser\Node\Stmt\Property;
use Rector\Doctrine\CodeQuality\Contract\PropertyAttributeTransformerInterface;
use Rector\Doctrine\CodeQuality\Helper\NodeValueNormalizer;
use Rector\Doctrine\CodeQuality\NodeFactory\AttributeFactory;
use Rector\Doctrine\CodeQuality\ValueObject\EntityMapping;
use Rector\Doctrine\Enum\MappingClass;
use Rector\PhpParser\Node\NodeFactory;

final readonly class EmbeddedPropertyAttributeTransformer implements PropertyAttributeTransformerInterface
{
    public function __construct(
        private NodeFactory $nodeFactory,
    ) {
    }

    public function transform(EntityMapping $entityMapping, Property|Param $property): bool
    {
        $propertyMapping = $entityMapping->matchEmbeddedPropertyMapping($property);
        if ($propertyMapping === null) {
            return false;
        }

        // handled in another attribute
        unset($propertyMapping['nullable']);

        $args = $this->nodeFactory->createArgs($propertyMapping);
        $property->attrGroups[] = AttributeFactory::createGroup($this->getClassName(), $args);

        NodeValueNormalizer::ensureKeyIsClassConstFetch($args, 'class');
        return true;
    }

    public function getClassName(): string
    {
        return MappingClass::EMBEDDED;
    }
}
