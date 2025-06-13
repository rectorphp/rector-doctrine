<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\TypedCollections\Rector\If_\RemoveUselessIsEmptyAssignRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(RemoveUselessIsEmptyAssignRector::class);
};
