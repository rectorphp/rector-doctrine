<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\Rector\Class_\RemoveRepositoryFromEntityAnnotationRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(RemoveRepositoryFromEntityAnnotationRector::class);
};
