<?php

declare(strict_types=1);

namespace Rector\Doctrine\TypeAnalyzer;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Attribute;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Identifier;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt\Property;
use PHPStan\PhpDocParser\Ast\NodeTraverser;
use PHPStan\PhpDocParser\Ast\Type\ArrayTypeNode;
use PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;
use PHPStan\PhpDocParser\Ast\Type\TypeNode;
use PHPStan\PhpDocParser\Ast\Type\UnionTypeNode;
use Rector\BetterPhpDocParser\PhpDoc\ArrayItemNode;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDoc\StringNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Doctrine\CodeQuality\Enum\CollectionMapping;
use Rector\Doctrine\CodeQuality\Enum\EntityMappingKey;
use Rector\Doctrine\CodeQuality\Enum\OdmMappingKey;
use Rector\Doctrine\NodeAnalyzer\AttrinationFinder;
use Rector\Doctrine\NodeAnalyzer\TargetEntityResolver;
use Rector\Doctrine\PhpDoc\ShortClassExpander;
use Rector\PhpDocParser\NodeTraverser\SimpleCallableNodeTraverser;
use Rector\StaticTypeMapper\Naming\NameScopeFactory;
use Rector\StaticTypeMapper\ValueObject\Type\FullyQualifiedObjectType;

final readonly class CollectionTypeResolver
{
    /**
     * @var string
     */
    private const TARGET_DOCUMENT = 'targetDocument';

    public function __construct(
        private NameScopeFactory $nameScopeFactory,
        private ShortClassExpander $shortClassExpander,
        private AttrinationFinder $attrinationFinder,
        private TargetEntityResolver $targetEntityResolver,
        private PhpDocInfoFactory $phpDocInfoFactory,
        private SimpleCallableNodeTraverser $simpleCallableNodeTraverser
    ) {
    }

    public function resolveFromTypeNode(TypeNode $typeNode, Node $node): ?FullyQualifiedObjectType
    {
        if ($typeNode instanceof UnionTypeNode) {
            foreach ($typeNode->types as $unionedTypeNode) {
                $resolvedUnionedType = $this->resolveFromTypeNode($unionedTypeNode, $node);
                if ($resolvedUnionedType instanceof FullyQualifiedObjectType) {
                    return $resolvedUnionedType;
                }
            }
        }

        if ($typeNode instanceof ArrayTypeNode && $typeNode->type instanceof IdentifierTypeNode) {
            $nameScope = $this->nameScopeFactory->createNameScopeFromNodeWithoutTemplateTypes($node);
            $fullyQualifiedName = $nameScope->resolveStringName($typeNode->type->name);
            return new FullyQualifiedObjectType($fullyQualifiedName);
        }

        return null;
    }

    public function hasIndexBy(Property|Param $property): bool
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNode($property);
        if ($phpDocInfo instanceof PhpDocInfo && str_contains((string) $phpDocInfo->getPhpDocNode(), 'indexBy')) {
            return true;
        }

        $attrGroups = $property->attrGroups;
        $hasIndexBy = false;

        $this->simpleCallableNodeTraverser->traverseNodesWithCallable(
            $attrGroups,
            function (Node $node) use (&$hasIndexBy): ?int {
                if ($node instanceof Arg && $node->name instanceof Identifier && $node->name->toString() === 'indexBy') {
                    $hasIndexBy = true;
                    return NodeTraverser::STOP_TRAVERSAL;
                }

                return null;
            }
        );

        return $hasIndexBy;
    }

    public function resolveFromToManyProperty(Property $property): ?FullyQualifiedObjectType
    {
        $doctrineAnnotationTagValueNodeOrAttribute = $this->attrinationFinder->getByMany(
            $property,
            CollectionMapping::TO_MANY_CLASSES
        );

        if ($doctrineAnnotationTagValueNodeOrAttribute instanceof DoctrineAnnotationTagValueNode) {
            return $this->resolveFromDoctrineAnnotationTagValueNode(
                $doctrineAnnotationTagValueNodeOrAttribute,
                $property
            );
        }

        if ($doctrineAnnotationTagValueNodeOrAttribute instanceof Attribute) {
            $targetEntityExpr = $this->findExprByArgNames(
                $doctrineAnnotationTagValueNodeOrAttribute->args,
                [EntityMappingKey::TARGET_ENTITY, OdmMappingKey::TARGET_DOCUMENT]
            );

            if (! $targetEntityExpr instanceof ClassConstFetch) {
                return null;
            }

            $targetEntityClassName = $this->targetEntityResolver->resolveFromExpr($targetEntityExpr);
            if ($targetEntityClassName === null) {
                return null;
            }

            return new FullyQualifiedObjectType($targetEntityClassName);
        }

        return null;
    }

    private function resolveFromDoctrineAnnotationTagValueNode(
        DoctrineAnnotationTagValueNode $doctrineAnnotationTagValueNode,
        Property $property
    ): ?FullyQualifiedObjectType {
        $targetEntityArrayItemNode = $doctrineAnnotationTagValueNode->getValue(EntityMappingKey::TARGET_ENTITY);

        // in case of ODM
        $targetDocumentArrayItemNode = $doctrineAnnotationTagValueNode->getValue(self::TARGET_DOCUMENT);

        $targetArrayItemNode = $targetEntityArrayItemNode ?: $targetDocumentArrayItemNode;
        if (! $targetArrayItemNode instanceof ArrayItemNode) {
            return null;
        }

        $targetEntityClass = $targetArrayItemNode->value;
        if ($targetEntityClass instanceof StringNode) {
            $targetEntityClass = $targetEntityClass->value;
        }

        if (! is_string($targetEntityClass)) {
            return null;
        }

        $fullyQualifiedTargetEntity = $this->shortClassExpander->resolveFqnTargetEntity(
            $targetEntityClass,
            $property
        );

        return new FullyQualifiedObjectType($fullyQualifiedTargetEntity);
    }

    /**
     * @param Arg[] $args
     * @param string[] $names
     */
    private function findExprByArgNames(array $args, array $names): ?Expr
    {
        foreach ($args as $arg) {
            if (! $arg->name instanceof Identifier) {
                continue;
            }

            if (in_array($arg->name->toString(), $names, true)) {
                return $arg->value;
            }
        }

        return null;

    }
}
