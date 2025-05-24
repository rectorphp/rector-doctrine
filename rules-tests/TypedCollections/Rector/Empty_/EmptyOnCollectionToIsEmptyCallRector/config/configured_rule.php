<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\TypedCollections\Rector\Empty_\EmptyOnCollectionToIsEmptyCallRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(EmptyOnCollectionToIsEmptyCallRector::class);
};
