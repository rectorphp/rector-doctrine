<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\Dbal211\Rector\MethodCall\ReplaceFetchAllMethodCallRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ReplaceFetchAllMethodCallRector::class);
};
