<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\CodeQuality\Rector\Property\ColumnTypeToTypesConstantRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ColumnTypeToTypesConstantRector::class);
};
