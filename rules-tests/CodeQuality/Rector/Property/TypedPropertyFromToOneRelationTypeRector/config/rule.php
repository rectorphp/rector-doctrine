<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\CodeQuality\Rector\Property\TypedPropertyFromToOneRelationTypeRector;
use Rector\ValueObject\PhpVersion;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(TypedPropertyFromToOneRelationTypeRector::class);

    $rectorConfig->phpVersion(PhpVersion::PHP_80);
};
