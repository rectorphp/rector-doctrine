<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\GetRepositoryServiceLocatorToRepositoryServiceInjectionRector\Fixture;

use Doctrine\ORM\EntityManagerInterface;
use Rector\Doctrine\Tests\CodeQuality\Rector\Class_\GetRepositoryServiceLocatorToRepositoryServiceInjectionRector\Source\SomeEntityUsingService;

final class GetRepositoryOnService
{
    public function run(EntityManagerInterface $entityManager)
    {
        $someRepository = $entityManager->getRepository(SomeEntityUsingService::class);

        return $someRepository->find(1);
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\GetRepositoryServiceLocatorToRepositoryServiceInjectionRector\Fixture;

use Doctrine\ORM\EntityManagerInterface;
use Rector\Doctrine\Tests\CodeQuality\Rector\Class_\GetRepositoryServiceLocatorToRepositoryServiceInjectionRector\Source\SomeEntityUsingService;

final class GetRepositoryOnService
{
    public function __construct(private readonly \Rector\Doctrine\Tests\CodeQuality\Rector\Class_\GetRepositoryServiceLocatorToRepositoryServiceInjectionRector\Source\SomeServiceRepository $someEntityUsingServiceRepository)
    {
    }
    public function run(EntityManagerInterface $entityManager)
    {
        $someRepository = $this->someEntityUsingServiceRepository;

        return $someRepository->find(1);
    }
}

?>
