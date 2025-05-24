<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(RemoveIfInstanceofCollectionRector::class);
};
