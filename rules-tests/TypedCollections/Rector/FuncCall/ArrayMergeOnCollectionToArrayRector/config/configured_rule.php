<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\TypedCollections\Rector\FuncCall\ArrayMergeOnCollectionToArrayRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ArrayMergeOnCollectionToArrayRector::class);
};
