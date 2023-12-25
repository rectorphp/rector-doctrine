<?php

declare(strict_types=1);

namespace Rector\Doctrine\Orm28\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\ClassMethod;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @changelog https://github.com/doctrine/orm/pull/7885
 * @changelog https://github.com/doctrine/orm/pull/8293
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
        return [MethodCall::class, ClassMethod::class];
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
        $query = $this->getEntityManager()->select('e')->from('entity')->getQuery();
        return $query->iterate();
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
        $query = $this->getEntityManager()->select('e')->from('entity')->getQuery();
        return $query->toIterable();
    }
}
CODE_SAMPLE
                ),
            ]
        );
    }

    /**
     * @param ClassMethod|MethodCall $node
     */
    public function refactor(Node $node): MethodCall|ClassMethod|null
    {
        if ($node instanceof ClassMethod) {
            return $this->refactorClassMethod($node);
        }

        // Change iterate() method calls to toIterable()
        if (! $this->isName($node->name, 'iterate')) {
            return null;
        }

        $node->name = new Identifier('toIterable');

        return $node;
    }

    private function refactorClassMethod(ClassMethod $classMethod): ?ClassMethod
    {
        if (! $classMethod->returnType instanceof Node) {
            return null;
        }

        if (! $this->isName($classMethod->returnType, 'Doctrine\ORM\Internal\Hydration\IterableResult')) {
            return null;
        }

        $classMethod->returnType = new Name('iterable');

        return $classMethod;
    }
}
