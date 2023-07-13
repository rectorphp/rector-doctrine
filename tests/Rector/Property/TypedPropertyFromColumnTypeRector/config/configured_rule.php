<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

use Rector\Core\ValueObject\PhpVersionFeature;

use Rector\Doctrine\Rector\Property\TypedPropertyFromColumnTypeRector;
use Rector\Doctrine\Tests\ConfigList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(ConfigList::MAIN);

    $rectorConfig->rule(TypedPropertyFromColumnTypeRector::class);

    $rectorConfig->phpVersion(PhpVersionFeature::UNION_TYPES);
};
