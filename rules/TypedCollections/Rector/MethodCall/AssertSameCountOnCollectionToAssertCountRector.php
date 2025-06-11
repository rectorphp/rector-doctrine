<?php

declare(strict_types=1);

namespace Rector\Doctrine\TypedCollections\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Identifier;
use Rector\Doctrine\TypedCollections\TypeAnalyzer\CollectionTypeDetector;
use Rector\PHPUnit\NodeAnalyzer\TestsNodeAnalyzer;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\AssertSameCountOnCollectionToAssertCountRector\AssertSameCountOnCollectionToAssertCountRectorTest
 */
final class AssertSameCountOnCollectionToAssertCountRector extends AbstractRector
{
    public function __construct(
        private readonly TestsNodeAnalyzer $testsNodeAnalyzer,
        private readonly CollectionTypeDetector $collectionTypeDetector
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Change $this->assertSame(5, $collection->count()) to $this->assertCount(5, $collection) in tests',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Doctrine\Common\Collections\Collection;

final class SomeClass extends \PHPUnit\Framework\TestCase
{
    private Collection $items;

    public function test(): void
    {
        $this->assertSame(5, $this->items->count());
    }
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
use Doctrine\Common\Collections\Collection;

final class SomeClass extends \PHPUnit\Framework\TestCase
{
    private Collection $items;

    public function test(): void
    {
        $this->assertCount(5, $this->items);
    }
}
CODE_SAMPLE
                )]
        );
    }

    public function getNodeTypes(): array
    {
        return [MethodCall::class];

    }

    /**
     * @param MethodCall $node
     */
    public function refactor(Node $node): MethodCall|null
    {
        if ($node->isFirstClassCallable()) {
            return null;
        }

        if (! $this->isName($node->name, 'assertSame')) {
            return null;
        }

        if (! $this->testsNodeAnalyzer->isInTestClass($node)) {
            return null;
        }

        $comparedArg = $node->getArgs()[1]
            ->value;

        if ($comparedArg instanceof MethodCall && $this->isName(
            $comparedArg->name,
            'count'
        ) && $this->collectionTypeDetector->isCollectionType($comparedArg->var)) {
            $node->name = new Identifier('assertCount');
            $node->args[1] = new Arg($comparedArg->var);

            return $node;
        }

        return null;
    }
}
