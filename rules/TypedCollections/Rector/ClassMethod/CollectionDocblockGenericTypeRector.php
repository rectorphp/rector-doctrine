<?php

declare(strict_types=1);

namespace Rector\Doctrine\TypedCollections\Rector\ClassMethod;

use PhpParser\Node;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Return_;
use Rector\Doctrine\Enum\DoctrineClass;
use Rector\Doctrine\TypedCollections\TypeAnalyzer\CollectionTypeDetector;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\CollectionDocblockGenericTypeRector\CollectionDocblockGenericTypeRectorTest
 */
final class CollectionDocblockGenericTypeRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Add more precise generics type to method that returns Collection',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

final class SomeClass
{
    public function getItems(): Collection
    {
        $collection = new ArrayCollection();
        $collection->add(new SomeClass());

        return $collection;
    }
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

final class SomeClass
{
    /**
     * @return Collection<int, SomeClass>
     */
    public function getItems(): Collection
    {
        $collection = new ArrayCollection();
        $collection->add(new SomeClass());

        return $collection;
    }
}
CODE_SAMPLE
                )]
        );
    }

    public function getNodeTypes(): array
    {
        return [ClassMethod::class];
    }

    /**
     * @param ClassMethod $node
     */
    public function refactor(Node $node): ?ClassMethod
    {
        if ($node->stmts === null) {
            return null;
        }

        // already different type
        if ($node->returnType instanceof \PhpParser\Node) {
            return null;
        }

        if ($node->returnType === null) {
            return null;
        }

        if (! $this->isName($node->returnType, DoctrineClass::COLLECTION)) {
            return null;
        }

        // find return
        // find new ArrayCollection()
        // improve return type

        return null;
    }
}
