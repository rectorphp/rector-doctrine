<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\CodeQuality\Rector\Class_\ExplicitRelationCollectionRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ExplicitRelationCollectionRector::class);
};
