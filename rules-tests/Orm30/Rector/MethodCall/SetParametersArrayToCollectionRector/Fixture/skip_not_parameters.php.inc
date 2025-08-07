<?php

namespace Rector\Doctrine\Tests\Orm30\Rector\MethodCall\SetParametersArrayToCollectionRector\Fixture;

final class SkipNotParameters
{
    public function createCustomQueryBuilder()
    {
        $ormQueryBuilder = new \Doctrine\ORM\QueryBuilder();
        $ormQueryBuilder->getQuery();
    }
}
?>
