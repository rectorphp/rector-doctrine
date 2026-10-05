<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\Orm37\Rector\MethodCall\DoctrineQueryBuilderSortDirectionRector;

return RectorConfig::configure()
    ->withRules([DoctrineQueryBuilderSortDirectionRector::class]);
