<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\TypedCollections\Rector\Class_\InitializeCollectionInConstructorRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(InitializeCollectionInConstructorRector::class);
};
