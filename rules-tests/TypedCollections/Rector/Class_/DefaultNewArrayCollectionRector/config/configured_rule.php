<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\TypedCollections\Rector\Class_\DefaultNewArrayCollectionRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(DefaultNewArrayCollectionRector::class);
};
