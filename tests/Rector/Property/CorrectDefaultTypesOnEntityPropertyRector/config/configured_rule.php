<?php

declare(strict_types=1);

use Rector\Doctrine\Rector\Property\CorrectDefaultTypesOnEntityPropertyRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/../../../../../config/config.php');

    $services = $containerConfigurator->services();

    $services->set(CorrectDefaultTypesOnEntityPropertyRector::class);
};
