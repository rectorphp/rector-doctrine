<?php

declare(strict_types=1);

namespace Utils\Rector\AnnotationTransformer\PropertyAnnotationTransformer;

use PhpParser\Node\Stmt\Property;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Utils\Rector\Contract\PropertyAnnotationTransformerInterface;
use Utils\Rector\DocTagNodeFactory;
use Utils\Rector\ValueObject\EntityMapping;

final class IdGeneratorAnnotationTransformer extends AbstractAnnotationTransformer implements PropertyAnnotationTransformerInterface
{
    public function transform(EntityMapping $entityMapping, PhpDocInfo $propertyPhpDocInfo, Property $property): void
    {
        $idMapping = $entityMapping->matchIdPropertyMapping($property);
        if (! is_array($idMapping)) {
            return;
        }

        $generator = $idMapping['generator'] ?? null;
        if (! is_array($generator)) {
            return;
        }

        $arrayItemNodes = $this->createArrayItemNodes($generator);

        $spacelessPhpDocTagNode = DocTagNodeFactory::createSpacelessPhpDocTagNode(
            $arrayItemNodes,
            $this->getClassName()
        );
        $propertyPhpDocInfo->addPhpDocTagNode($spacelessPhpDocTagNode);
    }

    public function getClassName(): string
    {
        return 'Doctrine\ORM\Mapping\GeneratedValue';
    }

    /**
     * @return string[]
     */
    public function getQuotedFields(): array
    {
        return ['strategy'];
    }
}
