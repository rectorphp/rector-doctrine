<?php

final class QueryBuilderCall
{
    public function createCustomQueryBuilder()
    {
        $ormQueryBuilder = new \Doctrine\ORM\QueryBuilder();
        $ormQueryBuilder->setParameters(new \Doctrine\Common\Collections\ArrayCollection([
            new \Doctrine\ORM\Query\Parameter('foo', 'bar'),
            new \Doctrine\ORM\Query\Parameter('bar', 1),
            new \Doctrine\ORM\Query\Parameter('baz', false),
        ]));
    }
}
?>
