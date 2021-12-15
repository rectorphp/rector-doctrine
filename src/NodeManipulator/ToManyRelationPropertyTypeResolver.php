<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeManipulator;

use PhpParser\Node\Stmt\Property;
use PHPStan\Type\Generic\GenericObjectType;
use PHPStan\Type\Type;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Doctrine\PhpDoc\ShortClassExpander;
use Rector\StaticTypeMapper\ValueObject\Type\FullyQualifiedObjectType;

final class ToManyRelationPropertyTypeResolver
{
    /**
     * @var string
     */
    private const COLLECTION_TYPE = 'Doctrine\Common\Collections\Collection';

    public function __construct(
        private readonly PhpDocInfoFactory $phpDocInfoFactory,
        private readonly ShortClassExpander $shortClassExpander,
    ) {
    }

    public function resolve(Property $property): ?Type
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);

        $toManyRelationTagValueNode = $phpDocInfo->getByAnnotationClasses([
            'Doctrine\ORM\Mapping\OneToMany',
            'Doctrine\ORM\Mapping\ManyToMany',
        ]);
        if ($toManyRelationTagValueNode !== null) {
            return $this->processToManyRelation($property, $toManyRelationTagValueNode);
        }

        return null;
    }

    private function processToManyRelation(
        Property $property,
        DoctrineAnnotationTagValueNode $doctrineAnnotationTagValueNode
    ): Type {
        $targetEntity = $doctrineAnnotationTagValueNode->getValueWithoutQuotes('targetEntity');

        if (! is_string($targetEntity)) {
            return new FullyQualifiedObjectType(self::COLLECTION_TYPE);
        }

        $entityFullyQualifiedClass = $this->shortClassExpander->resolveFqnTargetEntity($targetEntity, $property);
        $relatedEntityType = new FullyQualifiedObjectType($entityFullyQualifiedClass);

        return new GenericObjectType(self::COLLECTION_TYPE, [$relatedEntityType]);
    }
}
