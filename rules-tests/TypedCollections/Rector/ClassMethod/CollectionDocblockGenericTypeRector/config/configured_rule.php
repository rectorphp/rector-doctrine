<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\TypedCollections\Rector\ClassMethod\CollectionDocblockGenericTypeRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(CollectionDocblockGenericTypeRector::class);
};
