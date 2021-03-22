<?php

declare(strict_types=1);

namespace Rector\Doctrine\PhpDoc\Node\Class_;

use Rector\BetterPhpDocParser\Contract\PhpDocNode\SilentKeyNodeInterface;
use Rector\Doctrine\PhpDoc\Node\AbstractDoctrineTagValueNode;

final class InheritanceTypeTagValueNode extends AbstractDoctrineTagValueNode implements SilentKeyNodeInterface
{
    public function getShortName(): string
    {
        return '@ORM\InheritanceType';
    }

    public function getSilentKey(): string
    {
        return 'value';
    }
}
