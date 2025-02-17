<?php

final class QueryBuilderCall
{
    public function createCustomQueryBuilderWithDynamicArray()
    {
        $ormQueryBuilder = new \Doctrine\ORM\QueryBuilder();

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
-----
<?php

final class QueryBuilderCall
{
    public function createCustomQueryBuilderWithDynamicArray()
    {
        $ormQueryBuilder = new \Doctrine\ORM\QueryBuilder();

        $params = new \Doctrine\Common\Collections\ArrayCollection([new \Doctrine\ORM\Query\Parameter('name', 'John')]);
        if (true) {
            $ormQueryBuilder->andWhere('age > :age');
            $params->add(new \Doctrine\ORM\Query\Parameter('age', 18));
        }
        $params->add(new \Doctrine\ORM\Query\Parameter('lastName', 'bar'));
        $ormQueryBuilder->setParameters($params);
    }
}
?>
