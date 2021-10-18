<?php

namespace Rector\Doctrine\Tests\Set\DoctrineCodeQuality\Fixture;

use Doctrine\ORM\EntityRepository;

class SomeRepository extends EntityRepository
{
    public function getSomething()
    {
        $qb = $this
            ->createQueryBuilder()
        ;
        $qb->orderBy('id', 'Asc');

        return $qb->addOrderBy('name', 'asc')
            ->getQuery()
            ->getResult();
    }
}
?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\DoctrineCodeQuality\Fixture;

use Doctrine\ORM\EntityRepository;

class SomeRepository extends EntityRepository
{
    public function getSomething()
    {
        $qb = $this
            ->createQueryBuilder()
        ;
        $qb->orderBy('id', \Doctrine\Common\Collections\Criteria::ASC);

        return $qb->addOrderBy('name', \Doctrine\Common\Collections\Criteria::ASC)
            ->getQuery()
            ->getResult();
    }
}
?>
