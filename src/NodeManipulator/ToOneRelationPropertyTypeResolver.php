<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeManipulator;

use Doctrine\ORM\Mapping\JoinColumn;
use Nette\Utils\Strings;
use PhpParser\Node\Expr;
use PhpParser\Node\Stmt\Property;
use PHPStan\PhpDocParser\Ast\ConstExpr\ConstExprTrueNode;
use PHPStan\Type\MixedType;
use PHPStan\Type\NullType;
use PHPStan\Type\Type;
use PHPStan\Type\TypeCombinator;
use Rector\BetterPhpDocParser\PhpDoc\ArrayItemNode;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDoc\StringNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\BetterPhpDocParser\PhpDocParser\ClassAnnotationMatcher;
use Rector\Core\PhpParser\Node\Value\ValueResolver;
use Rector\Doctrine\NodeAnalyzer\AttributeFinder;
use Rector\Doctrine\NodeAnalyzer\TargetEntityResolver;
use Rector\NodeTypeResolver\PHPStan\Type\TypeFactory;
use Rector\StaticTypeMapper\ValueObject\Type\FullyQualifiedObjectType;

final class ToOneRelationPropertyTypeResolver
{
    /**
     * @var class-string[]
     */
    private const TO_ONE_ANNOTATION_CLASSES = ['Doctrine\ORM\Mapping\ManyToOne', 'Doctrine\ORM\Mapping\OneToOne'];

    public function __construct(
        private readonly TypeFactory $typeFactory,
        private readonly PhpDocInfoFactory $phpDocInfoFactory,
        private readonly ClassAnnotationMatcher $classAnnotationMatcher,
        private readonly AttributeFinder $attributeFinder,
        private readonly TargetEntityResolver $targetEntityResolver,
		private readonly ValueResolver $valueResolver,
    ) {
    }

    public function resolve(Property $property): ?Type
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);

        $doctrineAnnotationTagValueNode = $phpDocInfo->getByAnnotationClasses(self::TO_ONE_ANNOTATION_CLASSES);

        if ($doctrineAnnotationTagValueNode instanceof DoctrineAnnotationTagValueNode) {
            return $this->resolveFromDocBlock($phpDocInfo, $property, $doctrineAnnotationTagValueNode);
        }

        $expr = $this->attributeFinder->findAttributeByClassesArgByName(
            $property,
            self::TO_ONE_ANNOTATION_CLASSES,
            'targetEntity'
        );

        if (! $expr instanceof Expr) {
            return null;
        }

        $targetEntityClass = $this->targetEntityResolver->resolveFromExpr($expr);
        if ($targetEntityClass !== null) {
            return $this->resolveFromAttribute($targetEntityClass, $property);
        }

        return null;
    }

    private function processToOneRelation(
        Property $property,
        DoctrineAnnotationTagValueNode $toOneDoctrineAnnotationTagValueNode,
        bool $isNullable
    ): Type {
        $targetEntityArrayItemNode = $toOneDoctrineAnnotationTagValueNode->getValue('targetEntity');
        if (! $targetEntityArrayItemNode instanceof ArrayItemNode) {
            return new MixedType();
        }

        $targetEntityClass = $targetEntityArrayItemNode->value;

        if ($targetEntityClass instanceof StringNode) {
            $targetEntityClass = $targetEntityClass->value;
        }

        if (! is_string($targetEntityClass)) {
            return new MixedType();
        }

        if (\str_ends_with($targetEntityClass, '::class')) {
            $targetEntityClass = Strings::before($targetEntityClass, '::class');
        }

        // resolve to FQN
        $tagFullyQualifiedName = $this->classAnnotationMatcher->resolveTagFullyQualifiedName(
            $targetEntityClass,
            $property
        );
        if ($tagFullyQualifiedName === null) {
            return new MixedType();
        }

        $fullyQualifiedObjectType = new FullyQualifiedObjectType($tagFullyQualifiedName);

        return $this->resolveFromObjectType($fullyQualifiedObjectType, $isNullable);
    }

    private function shouldAddNullType(DoctrineAnnotationTagValueNode $doctrineAnnotationTagValueNode): bool
    {
        $isNullableValueArrayItemNode = $doctrineAnnotationTagValueNode->getValue('nullable');
        if (! $isNullableValueArrayItemNode instanceof ArrayItemNode) {
            return false;
        }

        return $isNullableValueArrayItemNode->value instanceof ConstExprTrueNode;
    }

    private function resolveFromDocBlock(
        PhpDocInfo $phpDocInfo,
        Property $property,
        DoctrineAnnotationTagValueNode $doctrineAnnotationTagValueNode
    ): Type {
        $joinDoctrineAnnotationTagValueNode = $phpDocInfo->findOneByAnnotationClass(
            'Doctrine\ORM\Mapping\JoinColumn'
        );

        return $this->processToOneRelation(
            $property,
            $doctrineAnnotationTagValueNode,
            $this->isNullableType($joinDoctrineAnnotationTagValueNode)
        );
    }

    private function resolveFromAttribute(string $targetEntityClass, Property $property): Type
    {
        $fullyQualifiedObjectType = new FullyQualifiedObjectType($targetEntityClass);

        $joinColumnNullableExpr = $this->attributeFinder->findAttributeByClassArgByName(
            $property,
            JoinColumn::class,
            'nullable'
        );

        if ($joinColumnNullableExpr === null) {
            $isNullable = true;
        } else {
            $isNullable = $this->valueResolver->getValue($joinColumnNullableExpr);
        }
        return $this->resolveFromObjectType($fullyQualifiedObjectType, $isNullable);
    }

    private function resolveFromObjectType(FullyQualifiedObjectType $fullyQualifiedObjectType, bool $isNullable): Type
    {
        $types = [];
        $types[] = $fullyQualifiedObjectType;

        if ($isNullable) {
            $types[] = new NullType();
        }

        return $this->typeFactory->createMixedPassedOrUnionType($types);
    }

    private function isNullableType(?DoctrineAnnotationTagValueNode $joinDoctrineAnnotationTagValueNode): bool
    {
        if (! $joinDoctrineAnnotationTagValueNode instanceof DoctrineAnnotationTagValueNode) {
            return true;
        }

        return $this->shouldAddNullType($joinDoctrineAnnotationTagValueNode);
    }
}
