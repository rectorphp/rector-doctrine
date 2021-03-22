<?php

declare(strict_types=1);

namespace Rector\Doctrine\Contract\PhpDoc\Node;

use PHPStan\PhpDocParser\Ast\Node;

interface DoctrineRelationTagValueNodeInterface extends Node
{
    public function getTargetEntity(): ?string;

    public function getFullyQualifiedTargetEntity(): ?string;

    public function changeTargetEntity(string $targetEntity): void;
}
