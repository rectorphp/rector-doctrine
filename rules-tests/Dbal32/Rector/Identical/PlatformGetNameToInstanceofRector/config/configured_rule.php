<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\Dbal32\Rector\Identical\PlatformGetNameToInstanceofRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(PlatformGetNameToInstanceofRector::class);
};
