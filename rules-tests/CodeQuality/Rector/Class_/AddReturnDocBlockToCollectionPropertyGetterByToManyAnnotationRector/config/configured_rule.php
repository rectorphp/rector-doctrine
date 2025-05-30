<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\TypedCollections\Rector\Class_\CompleteReturnDocblockFromToManyRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(CompleteReturnDocblockFromToManyRector::class);
};
