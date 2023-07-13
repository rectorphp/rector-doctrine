<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\ClassConstFetch\RenameClassConstFetchRector;
use Rector\Renaming\ValueObject\RenameClassAndConstFetch;

return static function (RectorConfig $rectorConfig): void {
    # https://github.com/doctrine/dbal/blob/master/UPGRADE.md#deprecated-type-constants
    $rectorConfig->ruleWithConfiguration(RenameClassConstFetchRector::class, [
        new RenameClassAndConstFetch('Doctrine\\DBAL\\Types\\Type', 'TARRAY', 'Doctrine\\DBAL\\Types\\Types', 'ARRAY'),
        new RenameClassAndConstFetch(
            'Doctrine\\DBAL\\Types\\Type',
            'SIMPLE_ARRAY',
            'Doctrine\\DBAL\\Types\\Types',
            'SIMPLE_ARRAY'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\DBAL\\Types\\Type',
            'JSON_ARRAY',
            'Doctrine\\DBAL\\Types\\Types',
            'JSON_ARRAY'
        ),
        new RenameClassAndConstFetch('Doctrine\\DBAL\\Types\\Type', 'JSON', 'Doctrine\\DBAL\\Types\\Types', 'JSON'),
        new RenameClassAndConstFetch('Doctrine\\DBAL\\Types\\Type', 'BIGINT', 'Doctrine\\DBAL\\Types\\Types', 'BIGINT'),
        new RenameClassAndConstFetch(
            'Doctrine\\DBAL\\Types\\Type',
            'BOOLEAN',
            'Doctrine\\DBAL\\Types\\Types',
            'BOOLEAN'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\DBAL\\Types\\Type',
            'DATETIME',
            'Doctrine\\DBAL\\Types\\Types',
            'DATETIME_MUTABLE'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\DBAL\\Types\\Type',
            'DATETIME_IMMUTABLE',
            'Doctrine\\DBAL\\Types\\Types',
            'DATETIME_IMMUTABLE'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\DBAL\\Types\\Type',
            'DATETIMETZ',
            'Doctrine\\DBAL\\Types\\Types',
            'DATETIMETZ_MUTABLE'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\DBAL\\Types\\Type',
            'DATETIMETZ_IMMUTABLE',
            'Doctrine\\DBAL\\Types\\Types',
            'DATETIMETZ_IMMUTABLE'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\DBAL\\Types\\Type',
            'DATE',
            'Doctrine\\DBAL\\Types\\Types',
            'DATE_MUTABLE'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\DBAL\\Types\\Type',
            'DATE_IMMUTABLE',
            'Doctrine\\DBAL\\Types\\Types',
            'DATE_IMMUTABLE'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\DBAL\\Types\\Type',
            'TIME',
            'Doctrine\\DBAL\\Types\\Types',
            'TIME_MUTABLE'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\DBAL\\Types\\Type',
            'TIME_IMMUTABLE',
            'Doctrine\\DBAL\\Types\\Types',
            'TIME_IMMUTABLE'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\DBAL\\Types\\Type',
            'DECIMAL',
            'Doctrine\\DBAL\\Types\\Types',
            'DECIMAL'
        ),
        new RenameClassAndConstFetch(
            'Doctrine\\DBAL\\Types\\Type',
            'INTEGER',
            'Doctrine\\DBAL\\Types\\Types',
            'INTEGER'
        ),
        new RenameClassAndConstFetch('Doctrine\\DBAL\\Types\\Type', 'OBJECT', 'Doctrine\\DBAL\\Types\\Types', 'OBJECT'),
        new RenameClassAndConstFetch(
            'Doctrine\\DBAL\\Types\\Type',
            'SMALLINT',
            'Doctrine\\DBAL\\Types\\Types',
            'SMALLINT'
        ),
        new RenameClassAndConstFetch('Doctrine\\DBAL\\Types\\Type', 'STRING', 'Doctrine\\DBAL\\Types\\Types', 'STRING'),
        new RenameClassAndConstFetch('Doctrine\\DBAL\\Types\\Type', 'TEXT', 'Doctrine\\DBAL\\Types\\Types', 'TEXT'),
        new RenameClassAndConstFetch('Doctrine\\DBAL\\Types\\Type', 'BINARY', 'Doctrine\\DBAL\\Types\\Types', 'BINARY'),
        new RenameClassAndConstFetch('Doctrine\\DBAL\\Types\\Type', 'BLOB', 'Doctrine\\DBAL\\Types\\Types', 'BLOB'),
        new RenameClassAndConstFetch('Doctrine\\DBAL\\Types\\Type', 'FLOAT', 'Doctrine\\DBAL\\Types\\Types', 'FLOAT'),
        new RenameClassAndConstFetch('Doctrine\\DBAL\\Types\\Type', 'GUID', 'Doctrine\\DBAL\\Types\\Types', 'GUID'),
        new RenameClassAndConstFetch(
            'Doctrine\\DBAL\\Types\\Type',
            'DATEINTERVAL',
            'Doctrine\\DBAL\\Types\\Types',
            'DATEINTERVAL'
        ),
    ]);
};
