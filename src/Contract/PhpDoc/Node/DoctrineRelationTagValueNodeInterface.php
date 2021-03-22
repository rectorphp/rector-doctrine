<?php

declare(strict_types=1);

namespace Rector\Doctrine\Contract\PhpDoc\Node;

interface DoctrineRelationTagValueNodeInterface
{
    public function getTargetEntity(): ?string;

    public function getFullyQualifiedTargetEntity(): ?string;

    public function changeTargetEntity(string $targetEntity): void;
}
