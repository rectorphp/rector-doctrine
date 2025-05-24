<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\Orm30\Rector\MethodCall\SetParametersArrayToCollectionRector;

return RectorConfig::configure()
    ->withRules([SetParametersArrayToCollectionRector::class]);
