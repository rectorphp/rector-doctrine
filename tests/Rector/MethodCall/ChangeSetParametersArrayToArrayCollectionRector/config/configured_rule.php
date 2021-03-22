<?php

declare(strict_types=1);

use Rector\Doctrine\Rector\MethodCall\ChangeSetParametersArrayToArrayCollectionRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/../../../../../config/config.php');

    $services = $containerConfigurator->services();

    $services->set(ChangeSetParametersArrayToArrayCollectionRector::class);
};
