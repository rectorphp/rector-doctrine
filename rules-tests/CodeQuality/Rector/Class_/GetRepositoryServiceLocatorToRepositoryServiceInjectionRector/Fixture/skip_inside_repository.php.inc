<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\GetRepositoryServiceLocatorToRepositoryServiceInjectionRector\Fixture;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Rector\Doctrine\Tests\CodeQuality\Rector\Class_\GetRepositoryServiceLocatorToRepositoryServiceInjectionRector\Source\Entity\SomeEntityUsingService;

final class SkipInsideRepository extends EntityRepository
{
    public function run(EntityManagerInterface $entityManager)
    {
        $someRepository = $entityManager->getRepository(SomeEntityUsingService::class);
    }
}
