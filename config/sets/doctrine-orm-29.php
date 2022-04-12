<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (\Rector\Config\RectorConfig $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/doctrine-annotations-to-attributes.php');
};
