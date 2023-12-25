<?php

declare(strict_types=1);

namespace Utils\Rector\AnnotationTransformer\PropertyAnnotationTransformer;

use PhpParser\Node\Stmt\Property;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Utils\Rector\Contract\PropertyAnnotationTransformerInterface;
use Utils\Rector\DocTagNodeFactory;
use Utils\Rector\ValueObject\EntityMapping;

final class GedmoTimestampableAnnotationTransformer extends AbstractAnnotationTransformer implements PropertyAnnotationTransformerInterface
{
    public function transform(EntityMapping $entityMapping, PhpDocInfo $propertyPhpDocInfo, Property $property): void
    {
        $fieldPropertyMapping = $entityMapping->matchFieldPropertyMapping($property);

        $timestampableMapping = $fieldPropertyMapping['gedmo']['timestampable'] ?? null;
        if (! is_array($timestampableMapping)) {
            return;
        }

        $arrayItemNodes = $this->createArrayItemNodes($timestampableMapping);
        $spacelessPhpDocTagNode = DocTagNodeFactory::createSpacelessPhpDocTagNode(
            $arrayItemNodes,
            $this->getClassName()
        );

        $propertyPhpDocInfo->addPhpDocTagNode($spacelessPhpDocTagNode);
    }

    public function getClassName(): string
    {
        return 'Gedmo\Mapping\Annotation\Timestampable';
    }

    /**
     * @return string[]
     */
    public function getQuotedFields(): array
    {
        return ['on'];
    }
}
