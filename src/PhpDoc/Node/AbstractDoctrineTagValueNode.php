<?php

declare(strict_types=1);

namespace Rector\Doctrine\PhpDoc\Node;

use Rector\BetterPhpDocParser\Contract\PhpDocNode\ShortNameAwareTagInterface;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\AbstractTagValueNode;
use Rector\Doctrine\Contract\PhpDoc\Node\DoctrineTagNodeInterface;

abstract class AbstractDoctrineTagValueNode extends AbstractTagValueNode implements DoctrineTagNodeInterface, ShortNameAwareTagInterface
{
}
