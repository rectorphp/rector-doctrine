<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\CodeQuality\Rector\Property\OrderByKeyToClassConstRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(OrderByKeyToClassConstRector::class);
};
