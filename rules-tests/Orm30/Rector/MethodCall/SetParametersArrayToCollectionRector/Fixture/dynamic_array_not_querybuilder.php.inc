<?php

namespace Rector\Doctrine\Tests\Orm30\Rector\MethodCall\SetParametersArrayToCollectionRector\Fixture;

final class QueryBuilderCall
{
    public function createCustomQueryBuilderWithDynamicArray()
    {
        $ormQueryBuilder = new class {

        };

        $params = ['name' => 'John'];
        if (true) {
            $ormQueryBuilder->andWhere('age > :age');
            $params['age'] = 18;
        }
        $params['lastName'] = 'bar';
        $ormQueryBuilder->setParameters($params);
    }
}
?>
