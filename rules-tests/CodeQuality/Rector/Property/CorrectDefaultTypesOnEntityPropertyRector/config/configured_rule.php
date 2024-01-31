<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\CodeQuality\Rector\Property\CorrectDefaultTypesOnEntityPropertyRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(CorrectDefaultTypesOnEntityPropertyRector::class);
};
