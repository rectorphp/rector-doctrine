<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\Set\DoctrineSetList;
use Rector\ValueObject\PhpVersionFeature;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->sets([__DIR__ . '/../../../../config/sets/doctrine-orm-219.php']);

    $rectorConfig->phpVersion(PhpVersionFeature::NEW_INITIALIZERS - 1);
};
