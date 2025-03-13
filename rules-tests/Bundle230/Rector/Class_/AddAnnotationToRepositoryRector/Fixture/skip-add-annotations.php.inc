<?php

namespace Rector\Doctrine\Tests\Bundle230\Rector\Class_\AddAnnotationToRepositoryRector\Fixture;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\SomeEntity;

/** @extends ServiceEntityRepository<SomeEntity> */
final class SkipAddAnnotationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SomeEntity::class);
    }
}
