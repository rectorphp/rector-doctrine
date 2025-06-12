<?php

declare(strict_types=1);

namespace Rector\Doctrine\TypedCollections\Rector\Property;

use Doctrine\Common\Collections\Collection;
use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Name;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;
use PhpParser\Node\UnionType;
use PHPStan\PhpDocParser\Ast\PhpDoc\VarTagValueNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Comments\NodeDocBlock\DocBlockUpdater;
use Rector\Doctrine\Enum\DoctrineClass;
use Rector\Doctrine\TypedCollections\DocBlockProcessor\UnionCollectionTagValueNodeNarrower;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Doctrine\Tests\TypedCollections\Rector\Property\NarrowPropertyUnionToCollectionRector\NarrowPropertyUnionToCollectionRectorTest
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
            'Narrow union type to Collection type in property docblock and native type declaration',
            [
                new CodeSample(
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
        return [Class_::class];
    }

    /**
     * @param Class_ $node
     */
    public function refactor(Node $node): ?Class_
    {
        $hasChanged = false;
        foreach ($node->getProperties() as $property) {
            if ($property->isAbstract()) {
                continue;
            }

            if ($this->refactorPropertyDocBlock($property)) {
                $hasChanged = true;
            }

            if ($this->refactorNativePropertyType($property)) {
                $hasChanged = true;
            }
        }

        if ($hasChanged) {
            return $node;
        }

        return null;
    }

    private function hasNativeTypeCollection(Property $property): bool
    {
        if (! $property->type instanceof Name) {
            return false;
        }

        return $this->isName($property->type, Collection::class);
    }

    private function isCollectionName(Node $node): bool
    {
        if (! $node instanceof Name) {
            return false;
        }

        return $this->isName($node, DoctrineClass::COLLECTION);
    }

    private function refactorNativePropertyType(Property $property): bool
    {
        if (! $property->type instanceof UnionType) {
            return false;
        }

        foreach ($property->type->types as $uniontedType) {
            if (! $this->isCollectionName($uniontedType)) {
                continue;
            }

            // narrow to pure collection
            $property->type = new FullyQualified(DoctrineClass::COLLECTION);

            // remove default, as will be defined in constructor by another rule
            if ($property->props[0]->default instanceof Expr) {
                $property->props[0]->default = null;
            }

            return true;
        }

        return false;
    }

    private function refactorPropertyDocBlock(Property $property): bool
    {
        $propertyPhpDocInfo = $this->phpDocInfoFactory->createFromNode($property);
        if (! $propertyPhpDocInfo instanceof PhpDocInfo) {
            return false;
        }

        $varTagValueNode = $propertyPhpDocInfo->getVarTagValueNode();

        if (! $varTagValueNode instanceof VarTagValueNode) {
            return false;
        }

        $hasNativeCollectionType = $this->hasNativeTypeCollection($property);

        if ($this->unionCollectionTagValueNodeNarrower->narrow($varTagValueNode, $hasNativeCollectionType)) {
            $this->docBlockUpdater->updateRefactoredNodeWithPhpDocInfo($property);
            return true;
        }

        return false;
    }
}
