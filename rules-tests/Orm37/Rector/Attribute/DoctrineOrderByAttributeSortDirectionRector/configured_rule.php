<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\Orm37\Rector\Attribute\DoctrineOrderByAttributeSortDirectionRector;

return RectorConfig::configure()
    ->withRules([DoctrineOrderByAttributeSortDirectionRector::class]);
