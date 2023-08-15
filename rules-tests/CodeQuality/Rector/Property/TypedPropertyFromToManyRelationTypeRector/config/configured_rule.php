<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

use Rector\Core\ValueObject\PhpVersionFeature;

use Rector\Doctrine\CodeQuality\Rector\Property\TypedPropertyFromToManyRelationTypeRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(TypedPropertyFromToManyRelationTypeRector::class);

    $rectorConfig->phpVersion(PhpVersionFeature::UNION_TYPES);
};
