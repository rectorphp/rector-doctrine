<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\ValueObject;

final readonly class NamespaceAlias
{
    public function __construct(
        private string $namespace,
        private string $alias,
    ) {}

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function getAlias(): string
    {
        return $this->alias;
    }
}
