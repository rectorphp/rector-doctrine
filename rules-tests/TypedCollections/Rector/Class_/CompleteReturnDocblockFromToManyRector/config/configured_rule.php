<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\TypedCollections\Rector\Class_\CompleteReturnDocblockFromToManyRector;

return function (RectorConfig $rectorConfig): void {
    $rectorConfig->rules([CompleteReturnDocblockFromToManyRector::class]);
};
