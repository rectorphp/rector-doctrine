<?php

declare(strict_types=1);

use Rector\Doctrine\Set\DoctrineSetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/../../../../config/config.php');

    $containerConfigurator->import(DoctrineSetList::DOCTRINE_REPOSITORY_AS_SERVICE);
};
