<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\Name\RenameClassRector;

return static function (RectorConfig $rectorConfig): void {
    $services = $rectorConfig->services();

    # https://github.com/doctrine/dbal/blob/master/UPGRADE.md#deprecated-type-constants
    $services->set(RenameClassRector::class)
        ->configure([
            'Doctrine\DBAL\Types\Type' => 'Doctrine\DBAL\Types\Types',
        ]);
};
