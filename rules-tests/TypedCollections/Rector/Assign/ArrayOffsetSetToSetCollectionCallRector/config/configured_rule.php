<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\TypedCollections\Rector\Assign\ArrayOffsetSetToSetCollectionCallRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ArrayOffsetSetToSetCollectionCallRector::class);
};
