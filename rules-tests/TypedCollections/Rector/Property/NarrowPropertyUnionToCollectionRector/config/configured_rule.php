<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\TypedCollections\Rector\Property\NarrowPropertyUnionToCollectionRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(NarrowPropertyUnionToCollectionRector::class);
};
