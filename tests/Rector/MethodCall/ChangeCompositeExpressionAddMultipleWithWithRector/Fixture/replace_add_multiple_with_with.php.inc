<?php

namespace Rector\Doctrine\Tests\Rector\MethodCall\ChangeCompositeExpressionAddMultipleWithWithRector\Fixture;

use Doctrine\DBAL\Query\Expression\CompositeExpression;
use Doctrine\ORM\EntityRepository;

class SomeRepository extends EntityRepository
{
    public function getSomething(array $parts)
    {
        $compositeExpression = CompositeExpression::and('', ...$parts);
        $compositeExpression->addMultiple($parts);
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Rector\MethodCall\ChangeCompositeExpressionAddMultipleWithWithRector\Fixture;

use Doctrine\DBAL\Query\Expression\CompositeExpression;
use Doctrine\ORM\EntityRepository;

class SomeRepository extends EntityRepository
{
    public function getSomething(array $parts)
    {
        $compositeExpression = CompositeExpression::and('', ...$parts);
        $compositeExpression->with(...$parts);
    }
}

?>
