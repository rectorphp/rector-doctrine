<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

use Rector\Doctrine\Set\DoctrineSetList;

return static function (RectorConfig $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/../../../../config/config.php');
    $containerConfigurator->import(DoctrineSetList::DOCTRINE_ODM_23);
};
