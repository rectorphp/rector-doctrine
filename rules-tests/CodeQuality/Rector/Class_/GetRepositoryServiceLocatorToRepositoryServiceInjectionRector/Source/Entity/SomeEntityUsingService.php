<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\GetRepositoryServiceLocatorToRepositoryServiceInjectionRector\Source\Entity;

use Rector\Doctrine\Tests\CodeQuality\Rector\Class_\GetRepositoryServiceLocatorToRepositoryServiceInjectionRector\Source\SomeServiceRepository;

/**
 * @ORM\Entity(repositoryClass=SomeServiceRepository::class)
 */
class SomeEntityUsingService
{
}
