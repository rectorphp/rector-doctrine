<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(NarrowArrayCollectionToCollectionRector::class);
};
