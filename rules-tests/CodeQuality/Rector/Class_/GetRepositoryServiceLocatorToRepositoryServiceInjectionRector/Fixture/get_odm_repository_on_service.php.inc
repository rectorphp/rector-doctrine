<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\GetRepositoryServiceLocatorToRepositoryServiceInjectionRector\Fixture;

use Doctrine\ODM\MongoDB\DocumentManager;
use Rector\Doctrine\Tests\CodeQuality\Rector\Class_\GetRepositoryServiceLocatorToRepositoryServiceInjectionRector\Source\Entity\SomeEntityUsingService;

final class GetODMRepositoryOnService
{
    public function run(DocumentManager $entityManager)
    {
        $someRepository = $entityManager->getRepository(SomeEntityUsingService::class);

        return $someRepository->find(1);
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\GetRepositoryServiceLocatorToRepositoryServiceInjectionRector\Fixture;

use Doctrine\ODM\MongoDB\DocumentManager;
use Rector\Doctrine\Tests\CodeQuality\Rector\Class_\GetRepositoryServiceLocatorToRepositoryServiceInjectionRector\Source\Entity\SomeEntityUsingService;

final class GetODMRepositoryOnService
{
    public function __construct(private readonly \Rector\Doctrine\Tests\CodeQuality\Rector\Class_\GetRepositoryServiceLocatorToRepositoryServiceInjectionRector\Source\SomeServiceRepository $someEntityUsingServiceRepository)
    {
    }
    public function run(DocumentManager $entityManager)
    {
        $someRepository = $this->someEntityUsingServiceRepository;

        return $someRepository->find(1);
    }
}

?>
