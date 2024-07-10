<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withRules([\Rector\Doctrine\Orm30\Rector\MethodCall\SetParametersArrayToCollectionRector::class]);
