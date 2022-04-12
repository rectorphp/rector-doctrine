<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

use Rector\Doctrine\Rector\Property\CorrectDefaultTypesOnEntityPropertyRector;

return static function (RectorConfig $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/../../../../../config/config.php');

    $services = $containerConfigurator->services();
    $services->set(CorrectDefaultTypesOnEntityPropertyRector::class);
};
