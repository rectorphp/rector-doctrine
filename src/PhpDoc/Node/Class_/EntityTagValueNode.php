<?php

declare(strict_types=1);

namespace Rector\Doctrine\PhpDoc\Node\Class_;

use Rector\Doctrine\PhpDoc\Node\AbstractDoctrineTagValueNode;

final class EntityTagValueNode extends AbstractDoctrineTagValueNode
{
    /**
     * @var string
     */
    private const REPOSITORY_CLASS = 'repositoryClass';

    public function removeRepositoryClass(): void
    {
        $this->items[self::REPOSITORY_CLASS] = null;
    }

    public function hasRepositoryClass(): bool
    {
        return $this->items[self::REPOSITORY_CLASS] !== null;
    }

    public function getRepositoryClass(): ?string
    {
        return $this->items[self::REPOSITORY_CLASS] ?? null;
    }

    public function getShortName(): string
    {
        return '@ORM\Entity';
    }
}
