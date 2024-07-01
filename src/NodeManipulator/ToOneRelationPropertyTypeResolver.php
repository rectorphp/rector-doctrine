<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeManipulator;

use Nette\Utils\Strings;
use PhpParser\Node\Expr;
use PhpParser\Node\Stmt\Property;
use PHPStan\PhpDocParser\Ast\ConstExpr\ConstExprTrueNode;
use PHPStan\Type\MixedType;
use PHPStan\Type\NullType;
use PHPStan\Type\Type;
use Rector\BetterPhpDocParser\PhpDoc\ArrayItemNode;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDoc\StringNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\BetterPhpDocParser\PhpDocParser\ClassAnnotationMatcher;
use Rector\Doctrine\NodeAnalyzer\AttributeFinder;
use Rector\Doctrine\NodeAnalyzer\TargetEntityResolver;
use Rector\NodeTypeResolver\PHPStan\Type\TypeFactory;
use Rector\StaticTypeMapper\ValueObject\Type\FullyQualifiedObjectType;

final readonly class ToOneRelationPropertyTypeResolver
{
    /**
     * @var class-string[]
     */
    private const TO_ONE_ANNOTATION_CLASSES = ['Doctrine\ORM\Mapping\ManyToOne', 'Doctrine\ORM\Mapping\OneToOne'];

    private const JOIN_COLUMN = ['Doctrine\ORM\Mapping\JoinColumn', 'Doctrine\ORM\Mapping\Column'];

    public function __construct(
        private TypeFactory $typeFactory,
        private PhpDocInfoFactory $phpDocInfoFactory,
        private ClassAnnotationMatcher $classAnnotationMatcher,
        private AttributeFinder $attributeFinder,
        private TargetEntityResolver $targetEntityResolver,
    ) {
    }

    public function resolve(Property $property, bool $forceNullable): ?Type
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);

        $doctrineAnnotationTagValueNode = $phpDocInfo->getByAnnotationClasses(self::TO_ONE_ANNOTATION_CLASSES);

        if ($doctrineAnnotationTagValueNode instanceof DoctrineAnnotationTagValueNode) {
            return $this->resolveFromDocBlock($phpDocInfo, $property, $doctrineAnnotationTagValueNode, $forceNullable);
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
            $fullyQualifiedObjectType = new FullyQualifiedObjectType($targetEntityClass);

            $isNullable = $forceNullable || $this->isNullableJoinColumn($property);
            return $this->resolveFromObjectType($fullyQualifiedObjectType, $isNullable);
        }

        return null;
    }

    private function processToOneRelation(
        Property $property,
        DoctrineAnnotationTagValueNode $toOneDoctrineAnnotationTagValueNode,
        ?DoctrineAnnotationTagValueNode $joinDoctrineAnnotationTagValueNode,
        bool $forceNullable
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
        $fullyQualifiedObjectType = new FullyQualifiedObjectType($tagFullyQualifiedName);

        $isNullable = $forceNullable || $this->isNullableType($joinDoctrineAnnotationTagValueNode);
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
        DoctrineAnnotationTagValueNode $doctrineAnnotationTagValueNode,
        bool $forceNullable
    ): Type {
        $joinDoctrineAnnotationTagValueNode = $phpDocInfo->findOneByAnnotationClass(
            'Doctrine\ORM\Mapping\JoinColumn'
        );

        return $this->processToOneRelation(
            $property,
            $doctrineAnnotationTagValueNode,
            $joinDoctrineAnnotationTagValueNode,
            $forceNullable
        );
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

    private function isNullableJoinColumn(Property $property): bool
    {
        $joinExpr = $this->attributeFinder->findAttributeByClassesArgByName(
            $property,
            self::JOIN_COLUMN,
            'nullable'
        );
        return $joinExpr instanceof Expr\ConstFetch && ! in_array('false', $joinExpr->name->getParts(), true);
    }
}
