<?php

declare(strict_types=1);

namespace Rector\Doctrine\Enum;

final class OrmClass
{
    /**
     * @var string
     */
    public const ENTITY_MANAGER_INTERFACE = 'Doctrine\ORM\EntityManagerInterface';

    /**
     * @var string
     */
    public const SERVICE_REPOSITORY_CLASS = 'Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository';
}
