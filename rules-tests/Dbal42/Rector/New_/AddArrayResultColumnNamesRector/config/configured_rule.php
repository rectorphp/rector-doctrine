<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\Dbal42\Rector\New_\AddArrayResultColumnNamesRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(AddArrayResultColumnNamesRector::class);
};
