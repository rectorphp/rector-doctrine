<?php

declare(strict_types=1);

namespace Doctrine\ORM;

use Doctrine\ORM\Internal\Hydration\IterableResult;

if (class_exists('Doctrine\ORM\AbstractQuery')) {
    return;
}

abstract class AbstractQuery
{
    public function iterate($parameters = null, $hydrationMode = null): IterableResult
    {
    }
}
