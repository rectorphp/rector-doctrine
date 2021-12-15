<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeManipulator;

use Nette\Utils\Strings;
use PhpParser\Node\Stmt\Property;
use PHPStan\PhpDocParser\Ast\ConstExpr\ConstExprTrueNode;
use PHPStan\Type\MixedType;
use PHPStan\Type\NullType;
use PHPStan\Type\Type;
use PHPStan\Type\TypeCombinator;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\BetterPhpDocParser\PhpDocParser\ClassAnnotationMatcher;
use Rector\NodeTypeResolver\PHPStan\Type\TypeFactory;
use Rector\StaticTypeMapper\ValueObject\Type\FullyQualifiedObjectType;

final class ToOneRelationPropertyTypeResolver
{
    public function __construct(
        private readonly TypeFactory $typeFactory,
        private readonly PhpDocInfoFactory $phpDocInfoFactory,
        private readonly ClassAnnotationMatcher $classAnnotationMatcher
    ) {
    }

    public function resolve(Property $property): ?Type
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);

        $toOneRelationTagValueNode = $phpDocInfo->getByAnnotationClasses([
            'Doctrine\ORM\Mapping\ManyToOne',
            'Doctrine\ORM\Mapping\OneToOne',
        ]);

        if ($toOneRelationTagValueNode !== null) {
            $joinDoctrineAnnotationTagValueNode = $phpDocInfo->findOneByAnnotationClass(
                'Doctrine\ORM\Mapping\JoinColumn'
            );

            return $this->processToOneRelation(
                $property,
                $toOneRelationTagValueNode,
                $joinDoctrineAnnotationTagValueNode
            );
        }

        return null;
    }

    private function processToOneRelation(
        Property $property,
        DoctrineAnnotationTagValueNode $toOneDoctrineAnnotationTagValueNode,
        ?DoctrineAnnotationTagValueNode $joinDoctrineAnnotationTagValueNode
    ): Type {
        $targetEntity = $toOneDoctrineAnnotationTagValueNode->getValueWithoutQuotes('targetEntity');
        if (! is_string($targetEntity)) {
            return new MixedType();
        }

        if (\str_ends_with($targetEntity, '::class')) {
            $targetEntity = Strings::before($targetEntity, '::class');
        }

        // resolve to FQN
        $tagFullyQualifiedName = $this->classAnnotationMatcher->resolveTagFullyQualifiedName($targetEntity, $property);

        $types = [];
        $types[] = new FullyQualifiedObjectType($tagFullyQualifiedName);

        if ($joinDoctrineAnnotationTagValueNode instanceof DoctrineAnnotationTagValueNode && $this->shouldAddNullType(
            $joinDoctrineAnnotationTagValueNode
        )) {
            $types[] = new NullType();
        }

        $propertyType = $this->typeFactory->createMixedPassedOrUnionType($types);

        // add default null if missing
        if (! TypeCombinator::containsNull($propertyType)) {
            $propertyType = TypeCombinator::addNull($propertyType);
        }

        return $propertyType;
    }

    private function shouldAddNullType(DoctrineAnnotationTagValueNode $doctrineAnnotationTagValueNode): bool
    {
        $isNullableValue = $doctrineAnnotationTagValueNode->getValue('nullable');
        return $isNullableValue instanceof ConstExprTrueNode;
    }
}
