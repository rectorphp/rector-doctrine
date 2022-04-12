<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

use Rector\Doctrine\Set\DoctrineSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/../../../../config/config.php');
    $rectorConfig->import(DoctrineSetList::DOCTRINE_CODE_QUALITY);
};
