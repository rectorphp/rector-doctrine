<?php

declare(strict_types=1);

namespace Rector\Doctrine\TypedCollections\Rector\ClassMethod;

use Doctrine\Common\Collections\ArrayCollection;
use PhpParser\Node;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Property;
use PhpParser\NodeFinder;
use PhpParser\NodeVisitorAbstract;
use PHPStan\PhpDocParser\Ast\PhpDoc\ParamTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\ReturnTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\VarTagValueNode;
use PHPStan\PhpDocParser\Ast\Type\GenericTypeNode;
use PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Comments\NodeDocBlock\DocBlockUpdater;
use Rector\Doctrine\Enum\DoctrineClass;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector\NarrowArrayCollectionToCollectionRectorTest
 */
final class NarrowArrayCollectionToCollectionRector extends AbstractRector
{
    public function __construct(
        private readonly PhpDocInfoFactory $phpDocInfoFactory,
        private readonly DocBlockUpdater $docBlockUpdater,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Narrow ArrayCollection to Collection in class method and property', [
            new CodeSample(
                <<<'CODE_SAMPLE'
use Doctrine\Common\Collections\ArrayCollection;

final class ArrayCollectionGeneric
{
    /**
     * @return ArrayCollection<int, string>
     */
    public function someMethod()
    {
    }
}
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
use Doctrine\Common\Collections\ArrayCollection;

final class ArrayCollectionGeneric
{
    /**
     * @return \Doctrine\Common\Collections\Collection<int, string>
     */
    public function someMethod()
    {
    }
}
CODE_SAMPLE
            )]);
    }

    public function getNodeTypes(): array
    {
        return [ClassMethod::class, Property::class];
    }

    /**
     * @param ClassMethod|Property $node
     */
    public function refactor(Node $node): ClassMethod|Property|null
    {
        if ($node instanceof ClassMethod) {
            return $this->refactorClassMethod($node);
        }

        $hasChanged = false;

        if ($this->processNativeType($node)) {
            $hasChanged = true;
        }

        $propertyDocNode = $this->phpDocInfoFactory->createFromNodeOrEmpty($node);

        $varTagValueNode = $propertyDocNode->getVarTagValueNode();
        if ($varTagValueNode instanceof VarTagValueNode && $this->processTagValueNode($varTagValueNode)) {
            $hasChanged = true;
        }

        if ($hasChanged) {
            return $node;
        }

        return null;
    }

    private function processTagValueNode(VarTagValueNode|ReturnTagValueNode|ParamTagValueNode $tagValueNode): bool
    {
        if ($tagValueNode->type instanceof GenericTypeNode) {
            $genericTypeNode = $tagValueNode->type;
            if ($genericTypeNode->type->name === 'ArrayCollection') {
                $genericTypeNode->type = new IdentifierTypeNode('\\' . DoctrineClass::COLLECTION);
                return true;
            }
        }

        if (! $tagValueNode->type instanceof IdentifierTypeNode) {
            return false;
        }

        if ($tagValueNode->type->name !== 'ArrayCollection') {
            return false;
        }

        $tagValueNode->type = new IdentifierTypeNode('\\' . DoctrineClass::COLLECTION);
        return true;
    }

    private function refactorClassMethodNativeTypes(ClassMethod $classMethod): bool
    {
        $hasChanged = false;

        foreach ($classMethod->params as $param) {
            if ($this->processNativeType($param)) {
                $hasChanged = true;
            }
        }

        if (! $classMethod->returnType instanceof Node) {
            return $hasChanged;
        }

        $hasReturnCollectionType = $this->hasCollectionName($classMethod);

        $this->traverseNodesWithCallable($classMethod->returnType, function (Node $node) use (
            $hasReturnCollectionType,
            &$hasChanged
        ): int|FullyQualified|null {
            if ($node instanceof Identifier && $this->isName($node, 'array')) {
                $hasChanged = true;
                if ($hasReturnCollectionType) {
                    return NodeVisitorAbstract::REMOVE_NODE;
                }
            }

            if ($node instanceof Name && $this->isName($node, ArrayCollection::class)) {
                $hasChanged = true;
                if ($hasReturnCollectionType) {
                    // we already have Collection, and can remove it
                    return NodeVisitorAbstract::REMOVE_NODE;
                }

                return new FullyQualified(DoctrineClass::COLLECTION);
            }

            return null;
        });

        if ($this->isName($classMethod->returnType, ArrayCollection::class)) {
            $classMethod->returnType = new FullyQualified(DoctrineClass::COLLECTION);
            $hasChanged = true;
        }

        return $hasChanged;
    }

    private function refactorClassMethod(ClassMethod $classMethod): ?ClassMethod
    {
        $hasChanged = $this->refactorClassMethodNativeTypes($classMethod);

        // docblocks
        $classMethodPhpDocInfo = $this->phpDocInfoFactory->createFromNode($classMethod);
        if (! $classMethodPhpDocInfo instanceof PhpDocInfo) {
            return null;
        }

        // return tag
        $returnTagValueNode = $classMethodPhpDocInfo->getReturnTagValue();
        if ($returnTagValueNode instanceof ReturnTagValueNode && $this->processTagValueNode($returnTagValueNode)) {
            $hasChanged = true;
        }

        // param tags
        foreach ($classMethodPhpDocInfo->getParamTagValueNodes() as $paramTagValueNode) {
            if ($this->processTagValueNode($paramTagValueNode)) {
                $hasChanged = true;
            }
        }

        if (! $hasChanged) {
            return null;
        }

        $this->docBlockUpdater->updateRefactoredNodeWithPhpDocInfo($classMethod);

        return $classMethod;
    }

    private function processNativeType(Param|Property $paramOrProperty): bool
    {
        if (! $paramOrProperty->type instanceof Node) {
            return false;
        }

        $hasCollectionName = $this->hasCollectionName($paramOrProperty);

        $hasChanged = false;
        if ($this->isName($paramOrProperty->type, ArrayCollection::class)) {
            $paramOrProperty->type = new FullyQualified(DoctrineClass::COLLECTION);
            return true;
        }

        $this->traverseNodesWithCallable($paramOrProperty->type, function (Node $node) use (
            $hasCollectionName,
            &$hasChanged
        ): null|int|FullyQualified {
            if (! $node instanceof Name) {
                return null;
            }

            if (! $this->isName($node, ArrayCollection::class)) {
                return null;
            }

            $hasChanged = true;
            if ($hasCollectionName) {
                // we already have Collection, and can remove it
                return NodeVisitorAbstract::REMOVE_NODE;
            }

            return new FullyQualified(DoctrineClass::COLLECTION);
        });

        return $hasChanged;
    }

    private function hasCollectionName(Property|Param|ClassMethod $stmts): bool
    {
        $typeNode = $stmts instanceof ClassMethod ? $stmts->returnType : $stmts->type;

        if ($typeNode === null) {
            return false;
        }

        $nodeFinder = new NodeFinder();
        $collectionName = $nodeFinder->findFirst($typeNode, function (Node $node): bool {
            if (! $node instanceof Name) {
                return false;
            }

            return $node->toString() === DoctrineClass::COLLECTION;
        });

        return $collectionName instanceof Name;
    }
}
