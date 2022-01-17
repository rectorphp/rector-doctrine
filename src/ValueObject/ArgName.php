<?php

declare(strict_types=1);

namespace Rector\Doctrine\ValueObject;

final class ArgName
{
    /**
     * @var string
     */
    final public const FETCH = 'fetch';

    /**
     * @var string
     */
    final public const LAZY = 'LAZY';

    /**
     * @var string
     */
    final public const ORPHAN_REMOVAL = 'orphanRemoval';
}
