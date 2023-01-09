<?php

namespace Rector\Doctrine\Tests\Rector\MethodCall\ChangeCompositeExpressionAddMultipleWithWithRector\Fixture;

use Doctrine\ORM\EntityRepository;

class TestClass
{
    public function addMultiple(array $parts)
    {
        return $parts;
    }
}
class SomeRepository extends EntityRepository
{
    public function getSomething($parts)
    {
        $testClass = new TestClass();
        $testClass->addMultiple($parts);
    }
}

?>
