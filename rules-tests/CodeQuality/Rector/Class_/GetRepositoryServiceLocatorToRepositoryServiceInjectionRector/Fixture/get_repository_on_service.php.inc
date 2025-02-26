<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\GetRepositoryServiceLocatorToRepositoryServiceInjectionRector\Fixture;

use Doctrine\ORM\EntityManagerInterface;
use Rector\Doctrine\Tests\CodeQuality\Rector\Class_\GetRepositoryServiceLocatorToRepositoryServiceInjectionRector\Source\Entity\SomeEntityUsingORMService;

final class GetRepositoryOnService
{
    public function run(EntityManagerInterface $entityManager)
    {
        $someRepository = $entityManager->getRepository(SomeEntityUsingORMService::class);

        return $someRepository->find(1);
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\GetRepositoryServiceLocatorToRepositoryServiceInjectionRector\Fixture;

use Doctrine\ORM\EntityManagerInterface;
use Rector\Doctrine\Tests\CodeQuality\Rector\Class_\GetRepositoryServiceLocatorToRepositoryServiceInjectionRector\Source\Entity\SomeEntityUsingORMService;

final class GetRepositoryOnService
{
    public function __construct(private readonly \Rector\Doctrine\Tests\CodeQuality\Rector\Class_\GetRepositoryServiceLocatorToRepositoryServiceInjectionRector\Source\SomeORMServiceRepository $someEntityUsingORMServiceRepository)
    {
    }
    public function run(EntityManagerInterface $entityManager)
    {
        $someRepository = $this->someEntityUsingORMServiceRepository;

        return $someRepository->find(1);
    }
}

?>
