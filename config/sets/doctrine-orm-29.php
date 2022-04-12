<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return static function (RectorConfig $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/doctrine-annotations-to-attributes.php');
};
