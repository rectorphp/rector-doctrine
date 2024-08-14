<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector;

return RectorConfig::configure()
    ->withRules([ImproveDoctrineCollectionDocTypeInEntityRector::class])
    ->withPhpVersion(\Rector\ValueObject\PhpVersionFeature::ATTRIBUTES);
