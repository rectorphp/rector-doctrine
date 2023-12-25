<?php

declare(strict_types=1);

namespace Utils\Rector\AnnotationTransformer\PropertyAnnotationTransformer;

use PhpParser\Node\Stmt\Property;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Utils\Rector\Contract\PropertyAnnotationTransformerInterface;
use Utils\Rector\DocTagNodeFactory;
use Utils\Rector\ValueObject\EntityMapping;

final class OneToManyAnnotationTransformer extends AbstractAnnotationTransformer implements PropertyAnnotationTransformerInterface
{
    public function transform(EntityMapping $entityMapping, PhpDocInfo $propertyPhpDocInfo, Property $property): void
    {
        $oneToManyMapping = $entityMapping->matchOneToManyPropertyMapping($property);
        if (! is_array($oneToManyMapping)) {
            return;
        }

        $arrayItemNodes = $this->createArrayItemNodes($oneToManyMapping);

        $spacelessPhpDocTagNode = DocTagNodeFactory::createSpacelessPhpDocTagNode(
            $arrayItemNodes,
            $this->getClassName()
        );

        $propertyPhpDocInfo->addPhpDocTagNode($spacelessPhpDocTagNode);
    }

    public function getClassName(): string
    {
        return 'Doctrine\ORM\Mapping\ManyToOne';
    }

    /**
     * @return string[]
     */
    public function getQuotedFields(): array
    {
        return ['targetEntity', 'mappedBy'];
    }
}
