<?php

declare(strict_types=1);

use Rector\Doctrine\Rector\Class_\AddEntityIdByConditionRector;
use Rector\Doctrine\Tests\Rector\Class_\AddEntityIdByConditionRector\Source\SomeTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/../../../../../config/config.php');

    $services = $containerConfigurator->services();

    $services->set(AddEntityIdByConditionRector::class)
        ->call('configure', [[
            AddEntityIdByConditionRector::DETECTED_TRAITS => [SomeTrait::class],
        ]]);
};
