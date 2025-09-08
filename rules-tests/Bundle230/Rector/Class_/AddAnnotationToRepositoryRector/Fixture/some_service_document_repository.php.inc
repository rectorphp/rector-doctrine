<?php

namespace Rector\Doctrine\Tests\Bundle230\Rector\Class_\AddAnnotationToRepositoryRector\Fixture;

use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\SomeEntity;

final class SomeServiceDocumentRepository extends ServiceDocumentRepository
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

use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\SomeEntity;

/**
 * @extends \Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository<\App\Entity\SomeEntity>
 */
final class SomeServiceDocumentRepository extends ServiceDocumentRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SomeEntity::class);
    }
}

?>
