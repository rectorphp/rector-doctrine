<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\CodeQuality\Rector\Class_\GetRepositoryServiceLocatorToRepositoryServiceInjectionRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(GetRepositoryServiceLocatorToRepositoryServiceInjectionRector::class);
};
