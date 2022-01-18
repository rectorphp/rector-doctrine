<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeManipulator;

use PhpParser\Node\Expr;
use PhpParser\Node\Stmt\Property;
use PHPStan\Type\Generic\GenericObjectType;
use PHPStan\Type\Type;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Core\PhpParser\Node\Value\ValueResolver;
use Rector\Doctrine\NodeAnalyzer\AttributeFinder;
use Rector\Doctrine\PhpDoc\ShortClassExpander;
use Rector\StaticTypeMapper\ValueObject\Type\FullyQualifiedObjectType;

final class ToManyRelationPropertyTypeResolver
{
    /**
     * @var string
     */
    private const COLLECTION_TYPE = 'Doctrine\Common\Collections\Collection';

    /**
     * @var class-string[]
     */
    private const TO_MANY_ANNOTATION_CLASSES = [
        'Doctrine\ORM\Mapping\OneToMany',
        'Doctrine\ORM\Mapping\ManyToMany',
    ];

    public function __construct(
        private readonly PhpDocInfoFactory $phpDocInfoFactory,
        private readonly ShortClassExpander $shortClassExpander,
        private readonly AttributeFinder $attributeFinder,
        private readonly ValueResolver $valueResolver,
    ) {
    }

    public function resolve(Property $property): ?Type
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);

        $toManyRelationTagValueNode = $phpDocInfo->getByAnnotationClasses(self::TO_MANY_ANNOTATION_CLASSES);
        if ($toManyRelationTagValueNode !== null) {
            return $this->processToManyRelation($property, $toManyRelationTagValueNode);
        }

        $targetEntity = $this->attributeFinder->findAttributeByClassesArgByName(
            $property,
            self::TO_MANY_ANNOTATION_CLASSES,
            'targetEntity'
        );

        if (! $targetEntity instanceof Expr) {
            return null;
        }

        return $this->resolveTypeFromTargetEntity($targetEntity, $property);
    }

    private function processToManyRelation(
        Property $property,
        DoctrineAnnotationTagValueNode $doctrineAnnotationTagValueNode
    ): Type|null {
        $targetEntity = $doctrineAnnotationTagValueNode->getValueWithoutQuotes('targetEntity');
        if (! is_string($targetEntity)) {
            return null;
        }

        return $this->resolveTypeFromTargetEntity($targetEntity, $property);
    }

    private function resolveTypeFromTargetEntity(Expr|string $targetEntity, Property $property): Type
    {
        if ($targetEntity instanceof Expr) {
            $targetEntity = $this->valueResolver->getValue($targetEntity);
        }

        if (! is_string($targetEntity)) {
            return new FullyQualifiedObjectType(self::COLLECTION_TYPE);
        }

        $entityFullyQualifiedClass = $this->shortClassExpander->resolveFqnTargetEntity($targetEntity, $property);
        $relatedEntityType = new FullyQualifiedObjectType($entityFullyQualifiedClass);

        return new GenericObjectType(self::COLLECTION_TYPE, [$relatedEntityType]);
    }
}
