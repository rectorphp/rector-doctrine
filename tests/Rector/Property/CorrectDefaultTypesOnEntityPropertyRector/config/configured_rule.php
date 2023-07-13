<?php

declare(strict_types=1);
use Rector\Doctrine\Tests\ConfigList;

use Rector\Config\RectorConfig;

use Rector\Doctrine\Rector\Property\CorrectDefaultTypesOnEntityPropertyRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(ConfigList::MAIN);

    $rectorConfig->rule(CorrectDefaultTypesOnEntityPropertyRector::class);
};
