<?php

namespace Rector\Doctrine\Tests\Orm30\Rector\MethodCall\CastDoctrineExprToStringRector\Fixture;

use Doctrine\ORM\Query\Expr;

final class ExprBuilderCall
{
    public function createCustomExprBuilder()
    {
        $expr = new Expr();
        $expr->like($expr->lower('test'), $expr->lower($expr->literal('%' . 'query' . '%')));
        $expr->like($expr->lower('test')->__toString(), $expr->lower($expr->literal('%' . 'query' . '%'))->__toString());
    }
}
?>
-----
<?php

namespace Rector\Doctrine\Tests\Orm30\Rector\MethodCall\CastDoctrineExprToStringRector\Fixture;

use Doctrine\ORM\Query\Expr;

final class ExprBuilderCall
{
    public function createCustomExprBuilder()
    {
        $expr = new Expr();
        $expr->like((string) $expr->lower('test'), (string) $expr->lower($expr->literal('%' . 'query' . '%')));
        $expr->like($expr->lower('test')->__toString(), $expr->lower($expr->literal('%' . 'query' . '%'))->__toString());
    }
}
?>
