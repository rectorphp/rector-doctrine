<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

use Rector\Doctrine\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector;


return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ImproveDoctrineCollectionDocTypeInEntityRector::class);
};
