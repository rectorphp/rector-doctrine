<?php

declare(strict_types=1);

namespace Doctrine\ORM;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

if (class_exists('Doctrine\ORM\EntityRepository')) {
    return;
}

// @see https://github.com/doctrine/orm/blob/2.8.x/lib/Doctrine/ORM/EntityRepository.php
/**
 * An EntityRepository serves as a repository for entities with generic as well as
 * business specific methods for retrieving entities.
 *
 * This class is designed for inheritance and users can subclass this class to
 * write their own repositories with business-specific methods to locate entities.
 *
 * @template T of object
 * @template-implements Selectable<int,T>
 * @template-implements ObjectRepository<T>
 */
class EntityRepository
{
    /**
     * @var EntityManagerInterface
     */
    protected $_em;

    public function createQueryBuilder(): QueryBuilder
    {
        return new QueryBuilder();
    }
}
