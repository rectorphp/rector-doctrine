<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\TypedCollections\Rector\Expression\RemoveAssertNotNullOnCollectionRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(RemoveAssertNotNullOnCollectionRector::class);
};
