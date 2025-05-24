<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\TypedCollections\Rector\New_\RemoveNewArrayCollectionWrapRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(RemoveNewArrayCollectionWrapRector::class);
};
