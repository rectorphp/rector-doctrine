<?php

declare(strict_types=1);

namespace Rector\Doctrine\PhpDoc\Node\Class_;

use Rector\Doctrine\PhpDoc\Node\AbstractDoctrineTagValueNode;

final class EmbeddableTagValueNode extends AbstractDoctrineTagValueNode
{
    public function getShortName(): string
    {
        return '@ORM\Embeddable';
    }
}
