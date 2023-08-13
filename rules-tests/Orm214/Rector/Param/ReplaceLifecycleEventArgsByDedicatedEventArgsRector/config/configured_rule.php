<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\Orm214\Rector\Param\ReplaceLifecycleEventArgsByDedicatedEventArgsRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ReplaceLifecycleEventArgsByDedicatedEventArgsRector::class);
};
