<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector;
use Rector\ValueObject\PhpVersion;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(TypedPropertyFromToManyRelationTypeRector::class);

    $rectorConfig->phpVersion(PhpVersion::PHP_80);
};
