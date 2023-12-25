<?php

declare(strict_types=1);

namespace Utils\Rector\AnnotationTransformer\PropertyAnnotationTransformer;

use PhpParser\Node\Stmt\Property;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Utils\Rector\Contract\PropertyAnnotationTransformerInterface;
use Utils\Rector\DocTagNodeFactory;
use Utils\Rector\ValueObject\EntityMapping;

final class IdAnnotationTransformer extends AbstractAnnotationTransformer implements PropertyAnnotationTransformerInterface
{
    public function transform(EntityMapping $entityMapping, PhpDocInfo $propertyPhpDocInfo, Property $property): void
    {
        $idMapping = $entityMapping->matchIdPropertyMapping($property);
        if (! is_array($idMapping)) {
            return;
        }

        $spacelessPhpDocTagNode = DocTagNodeFactory::createSpacelessPhpDocTagNode([], $this->getClassName());
        $propertyPhpDocInfo->addPhpDocTagNode($spacelessPhpDocTagNode);
    }

    public function getClassName(): string
    {
        return 'Doctrine\ORM\Mapping\Id';
    }

    /**
     * @return string[]
     */
    public function getQuotedFields(): array
    {
        return [];
    }
}
