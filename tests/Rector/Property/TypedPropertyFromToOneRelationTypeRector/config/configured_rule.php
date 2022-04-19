<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

use Rector\Core\ValueObject\PhpVersionFeature;
use Rector\Doctrine\Rector\Property\TypedPropertyFromToOneRelationTypeRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/../../../../../config/config.php');

    $rectorConfig->rule(TypedPropertyFromToOneRelationTypeRector::class);

    $rectorConfig->phpVersion(PhpVersionFeature::UNION_TYPES);
};
