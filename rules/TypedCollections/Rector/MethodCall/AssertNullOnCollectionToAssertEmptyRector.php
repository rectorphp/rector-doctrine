<?php

declare(strict_types=1);

namespace Rector\Doctrine\TypedCollections\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Identifier;
use Rector\Doctrine\TypedCollections\TypeAnalyzer\CollectionTypeDetector;
use Rector\PHPUnit\NodeAnalyzer\TestsNodeAnalyzer;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\AssertNullOnCollectionToAssertEmptyRector\AssertNullOnCollectionToAssertEmptyRectorTest
 */
final class AssertNullOnCollectionToAssertEmptyRector extends AbstractRector
{
    public function __construct(
        private readonly TestsNodeAnalyzer $testsNodeAnalyzer,
        private readonly CollectionTypeDetector $collectionTypeDetector
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Change $this->assertNull() on Collection object to $this->assertEmpty() in tests',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Doctrine\Common\Collections\Collection;

final class SomeClass extends \PHPUnit\Framework\TestCase
{
    private Collection $items;

    public function test(): void
    {
        $this->assertNull($this->items);
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
        $this->assertEmpty($this->items);
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

        if (! $this->isName($node->name, 'assertNull')) {
            return null;
        }

        if (! $this->testsNodeAnalyzer->isInTestClass($node)) {
            return null;
        }

        $firstArg = $node->getArgs()[0];

        if (! $this->collectionTypeDetector->isCollectionType($firstArg->value)) {
            return null;
        }

        // rename
        $node->name = new Identifier('assertEmpty');

        return $node;
    }
}
