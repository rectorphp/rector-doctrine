<?php

declare(strict_types=1);

namespace Rector\Doctrine\PhpDoc\Node\Property_;

use Rector\Doctrine\PhpDoc\Node\AbstractDoctrineTagValueNode;

final class IdTagValueNode extends AbstractDoctrineTagValueNode
{
    public function getShortName(): string
    {
        return '@ORM\Id';
    }
}
