<?php

namespace Rector\Doctrine\Tests\Set\DoctrineCodeQuality\Fixture;

use Doctrine\ORM\EntityRepository;

class SomeRepository extends EntityRepository
{
    public function getSomething()
    {
        $qb = $this
            ->createQueryBuilder('sm')
        ;
        $qb->orderBy('id', 'ASC');

        return $qb->addOrderBy('id', 'ASC')
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
            ->createQueryBuilder('sm')
        ;
        $qb->orderBy('id', \Doctrine\Common\Collections\Criteria::ASC);

        return $qb->addOrderBy('id', \Doctrine\Common\Collections\Criteria::ASC)
            ->getQuery()
            ->getResult();
    }
}
?>
