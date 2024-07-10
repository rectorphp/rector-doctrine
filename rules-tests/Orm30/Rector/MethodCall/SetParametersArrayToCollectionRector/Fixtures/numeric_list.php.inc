<?php

final class QueryBuilderCall
{
    public function createCustomQueryBuilderWithNumeric()
    {
        $ormQueryBuilder = new \Doctrine\ORM\QueryBuilder();
        $ormQueryBuilder->setParameters([
            'one',
            'two',
            'three'
        ]);
    }
}
?>
-----
<?php

final class QueryBuilderCall
{
    public function createCustomQueryBuilderWithNumeric()
    {
        $ormQueryBuilder = new \Doctrine\ORM\QueryBuilder();
        $ormQueryBuilder->setParameters(new \Doctrine\Common\Collections\ArrayCollection([new \Doctrine\ORM\Query\Parameter(0, 'one'), new \Doctrine\ORM\Query\Parameter(1, 'two'), new \Doctrine\ORM\Query\Parameter(2, 'three')]));
    }
}
?>
