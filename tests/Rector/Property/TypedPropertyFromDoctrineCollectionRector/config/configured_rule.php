<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

use Rector\Doctrine\Rector\Property\TypedPropertyFromDoctrineCollectionRector;
use Rector\Doctrine\Tests\ConfigList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(ConfigList::MAIN);

    $rectorConfig->rule(TypedPropertyFromDoctrineCollectionRector::class);
};
