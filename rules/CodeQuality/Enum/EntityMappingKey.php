<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\Enum;

/**
 * @api
 */
final class EntityMappingKey
{
    public const string NULLABLE = 'nullable';

    public const string COLUMN_PREFIX = 'columnPrefix';

    public const string COLUMN = 'column';

    public const string STRATEGY = 'strategy';

    public const string GENERATOR = 'generator';

    public const string ORDER_BY = 'orderBy';

    public const string NAME = 'name';

    public const string TARGET_ENTITY = 'targetEntity';
}
