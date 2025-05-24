<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\TypedCollections\Rector\ClassMethod\NarrowParamUnionToCollectionRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(NarrowParamUnionToCollectionRector::class);
};
