<?php

namespace Rector\Doctrine\Tests\Bundle230\Rector\Class_\AddAnnotationToRepositoryRector\Fixture;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\SomeEntity;

final class SomeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SomeEntity::class);
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Bundle230\Rector\Class_\AddAnnotationToRepositoryRector\Fixture;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\SomeEntity;

/**
 * @extends ServiceEntityRepository<App\Entity\SomeEntity>
 */
final class SomeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SomeEntity::class);
    }
}

?>
