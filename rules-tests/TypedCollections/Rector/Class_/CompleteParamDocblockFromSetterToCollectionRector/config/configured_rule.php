<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\TypedCollections\Rector\Class_\CompleteParamDocblockFromSetterToCollectionRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rules([CompleteParamDocblockFromSetterToCollectionRector::class]);
};
