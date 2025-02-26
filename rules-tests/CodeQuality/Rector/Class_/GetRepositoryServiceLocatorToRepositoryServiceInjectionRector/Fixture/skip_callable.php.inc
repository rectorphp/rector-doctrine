<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\GetRepositoryServiceLocatorToRepositoryServiceInjectionRector\Fixture;

use Doctrine\ORM\EntityManagerInterface;

final class SkipCallable
{
    public function run(EntityManagerInterface $entityManager)
    {
        $someRepository = $entityManager->getRepository(...);
    }
}
