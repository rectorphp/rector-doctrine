<?php

declare(strict_types=1);

namespace Utils\Rector\AnnotationTransformer\PropertyAnnotationTransformer;

use PhpParser\Node\Stmt\Property;
use Rector\BetterPhpDocParser\PhpDoc\ArrayItemNode;
use Rector\BetterPhpDocParser\PhpDoc\StringNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Utils\Rector\Contract\PropertyAnnotationTransformerInterface;
use Utils\Rector\DocTagNodeFactory;
use Utils\Rector\ValueObject\EntityMapping;

final class IdColumnAnnotationTransformer extends AbstractAnnotationTransformer implements PropertyAnnotationTransformerInterface
{
    public function transform(EntityMapping $entityMapping, PhpDocInfo $propertyPhpDocInfo, Property $property): void
    {
        $idMapping = $entityMapping->matchIdPropertyMapping($property);
        if (! is_array($idMapping)) {
            return;
        }

        $arrayItemNodes = [];

        $type = $idMapping['type'] ?? null;
        if ($type) {
            $arrayItemNodes[] = new ArrayItemNode(new StringNode($type), 'type');
        }

        $spacelessPhpDocTagNode = DocTagNodeFactory::createSpacelessPhpDocTagNode(
            $arrayItemNodes,
            $this->getClassName()
        );
        $propertyPhpDocInfo->addPhpDocTagNode($spacelessPhpDocTagNode);
    }

    public function getClassName(): string
    {
        return 'Doctrine\ORM\Mapping\Column';
    }

    /**
     * @return string[]
     */
    public function getQuotedFields(): array
    {
        return [];
    }
}
