<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\Enum;

final class EntityMappingKey
{
    /**
     * @var string
     */
    public const NULLABLE = 'nullable';

    /**
     * @var string
     */
    public const COLUMN_PREFIX = 'columnPrefix';

    /**
     * @var string
     */
    public const STRATEGY = 'strategy';

    /**
     * @var string
     */
    public const GENERATOR = 'generator';
}
