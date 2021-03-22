<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeManipulator;

use Rector\Doctrine\PhpDoc\Node\Property_\ColumnTagValueNode;

final class ColumnDatetimePropertyManipulator
{
    public function removeDefaultOption(ColumnTagValueNode $columnTagValueNode): void
    {
        $options = $columnTagValueNode->getOptions();
        unset($options['default']);

        $columnTagValueNode->changeItem('options', $options);
    }
}
