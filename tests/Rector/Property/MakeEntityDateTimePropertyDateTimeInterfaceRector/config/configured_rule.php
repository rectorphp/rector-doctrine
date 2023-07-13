<?php

declare(strict_types=1);
use Rector\Doctrine\Tests\ConfigList;

use Rector\Config\RectorConfig;

use Rector\Doctrine\CodeQuality\Rector\Property\MakeEntityDateTimePropertyDateTimeInterfaceRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(ConfigList::MAIN);

    $rectorConfig->rule(MakeEntityDateTimePropertyDateTimeInterfaceRector::class);
};
