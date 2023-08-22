<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

use Rector\Doctrine\Orm28\Rector\MethodCall\IterateToToIterableRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(IterateToToIterableRector::class);
};
