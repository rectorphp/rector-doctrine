<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\TypedCollections\Rector\Assign\ArrayDimFetchAssignToAddCollectionCallRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ArrayDimFetchAssignToAddCollectionCallRector::class);
};
