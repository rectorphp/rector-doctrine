<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

use Rector\Doctrine\CodeQuality\Rector\Class_\InitializeDefaultEntityCollectionRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/../../../../../config/config.php');
    $rectorConfig->importNames();

    $rectorConfig->rule(InitializeDefaultEntityCollectionRector::class);
};
