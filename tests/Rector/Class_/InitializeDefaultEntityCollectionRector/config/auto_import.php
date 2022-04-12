<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

use Rector\Core\Configuration\Option;
use Rector\Doctrine\Rector\Class_\InitializeDefaultEntityCollectionRector;

return static function (RectorConfig $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/../../../../../config/config.php');
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::AUTO_IMPORT_NAMES, true);

    $services = $containerConfigurator->services();
    $services->set(InitializeDefaultEntityCollectionRector::class);
};
