<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\ValueObject\PhpVersion;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->sets([__DIR__ . '/../../../../config/sets/typed-collections.php']);

    $rectorConfig->phpVersion(PhpVersion::PHP_84);

    $rectorConfig->importNames();
    $rectorConfig->importShortClasses();
};
