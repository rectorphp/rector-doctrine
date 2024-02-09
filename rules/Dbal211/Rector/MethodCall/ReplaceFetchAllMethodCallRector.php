<?php

declare(strict_types=1);

namespace Rector\Doctrine\Dbal211\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Identifier;
use PHPStan\Type\ObjectType;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Doctrine\Tests\Dbal211\Rector\MethodCall\ReplaceFetchAllMethodCallRector\ReplaceFetchAllMethodCallRectorTest
 *
 * @changelog https://github.com/doctrine/dbal/pull/4019
 */
final class ReplaceFetchAllMethodCallRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Change Doctrine\DBAL\Connection ->fetchAll() to ->fetchAllAssociative() and other replacements',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Doctrine\DBAL\Connection;

class SomeClass
{
    public function run(Connection $connection)
    {
        return $connection->fetchAll();
    }
}
CODE_SAMPLE

                    ,
                    <<<'CODE_SAMPLE'
use Doctrine\DBAL\Connection;

class SomeClass
{
    public function run(Connection $connection)
    {
        return $connection->fetchAllAssociative();
    }
}
CODE_SAMPLE
                ),

            ]
        );
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [MethodCall::class];
    }

    /**
     * @param MethodCall $node
     */
    public function refactor(Node $node): ?Node
    {
        if (! $this->isObjectType($node->var, new ObjectType('Doctrine\DBAL\Connection'))) {
            return null;
        }

        if ($this->isName($node->name, 'fetchAll')) {
            $node->name = new Identifier('fetchAllAssociative');
            return $node;
        }

        if ($this->isName($node->name, 'fetchArray')) {
            $node->name = new Identifier('fetchNumeric');
            return $node;
        }

        return null;
    }
}
