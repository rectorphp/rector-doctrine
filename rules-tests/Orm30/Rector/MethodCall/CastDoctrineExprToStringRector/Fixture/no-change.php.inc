<?php

namespace Rector\Doctrine\Tests\Orm30\Rector\MethodCall\CastDoctrineExprToStringRector\Fixture;

use Doctrine\ORM\Query\Expr;

final class SkipLiteral
{
    public function createCustomExprBuilder()
    {
        $expr = new Expr();
        $expr->eq('column', $expr->literal('value'));
    }
}
?>
