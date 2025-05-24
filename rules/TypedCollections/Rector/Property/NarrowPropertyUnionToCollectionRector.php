<?php

declare(strict_types=1);

namespace Rector\Doctrine\TypedCollections\Rector\Property;

use Doctrine\Common\Collections\Collection;
use PhpParser\Node;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Property;
use PHPStan\PhpDocParser\Ast\PhpDoc\VarTagValueNode;
use PHPStan\Reflection\ClassReflection;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Comments\NodeDocBlock\DocBlockUpdater;
use Rector\Doctrine\TypedCollections\DocBlockProcessor\UnionCollectionTagValueNodeNarrower;
use Rector\PHPStan\ScopeFetcher;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowParamUnionToCollectionRector\NarrowParamUnionToCollectionRectorTest
 */
final class NarrowPropertyUnionToCollectionRector extends AbstractRector
{
    public function __construct(
        private readonly PhpDocInfoFactory $phpDocInfoFactory,
        private readonly DocBlockUpdater $docBlockUpdater,
        private readonly UnionCollectionTagValueNodeNarrower $unionCollectionTagValueNodeNarrower
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Narrow union type to Collection type in property docblock',
            [
                new \Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample(
                    <<<'CODE_SAMPLE'
use Doctrine\Common\Collections\Collection;

class SomeClass
{
    /**
     * @var Collection|array
     */
    private $property;
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
use Doctrine\Common\Collections\Collection;

class SomeClass
{
    /**
     * @var Collection
     */
    private $property;
}
CODE_SAMPLE
                ),
            ]
        );
    }

    public function getNodeTypes(): array
    {
        return [Property::class];
    }

    /**
     * @param Property $node
     */
    public function refactor(Node $node): ?Property
    {
        if ($node->isAbstract()) {
            return null;
        }

        $scope = ScopeFetcher::fetch($node);
        $classReflection = $scope->getClassReflection();
        if (! $classReflection instanceof ClassReflection) {
            return null;
        }

        if ($classReflection->isInterface()) {
            return null;
        }

        $propertyPhpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($node);

        $varTagValueNode = $propertyPhpDocInfo->getVarTagValueNode();
        if (! $varTagValueNode instanceof VarTagValueNode) {
            return null;
        }

        $hasNativeCollectionType = false;
        if ($node->type instanceof Name && $this->isName($node->type, Collection::class)) {
            $hasNativeCollectionType = true;
        }

        $hasChanged = $this->unionCollectionTagValueNodeNarrower->narrow($varTagValueNode, $hasNativeCollectionType);

        if ($hasChanged === false) {
            return null;
        }

        $this->docBlockUpdater->updateRefactoredNodeWithPhpDocInfo($node);

        return $node;
    }
}
