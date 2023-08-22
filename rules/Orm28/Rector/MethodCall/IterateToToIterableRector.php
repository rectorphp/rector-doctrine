<?php

declare(strict_types=1);

namespace Rector\Doctrine\Orm28\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Type\ObjectType;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see https://github.com/doctrine/orm/pull/7885
 * @see https://github.com/doctrine/orm/pull/8293
 *
 * @see \Rector\Doctrine\Tests\Orm28\Rector\MethodCall\IterateToToIterableRector\IterateToToIterableRectorTest
 */
final class IterateToToIterableRector extends AbstractRector
{
    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [MethodCall::class];
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Change iterate() => toIterable()',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Internal\Hydration\IterableResult;

class SomeRepository extends EntityRepository
{
    public function run(): IterateResult
    {
        return $this->>getEntityManager()->select('e')->from('entity')->getQuery()->iterate();
    }
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Internal\Hydration\IterableResult;

class SomeRepository extends EntityRepository
{
    public function run(): iterable
    {
        return $this->>getEntityManager()->select('e')->from('entity')->getQuery()->toIterable();
    }
}
CODE_SAMPLE
                ),
            ]
        );
    }

    public function refactor(Node $node): ?Node
    {
        // Change iterate() method calls to toIterable()
        if (!$this->isName($node->name, 'iterate')) {
            return null;
        }
        $node->name->name = 'toIterable';

        if ($node->getAttribute('parent')->getAttribute('parent') instanceof Node\Stmt\ClassMethod
            && $this->isName($node->getAttribute('parent')->getAttribute('parent')->returnType, 'Doctrine\ORM\Internal\Hydration\IterableResult')) {
            $node->getAttribute('parent')->getAttribute('parent')->returnType = new Node\Name('iterable');
        }

        return $node;
    }
}
