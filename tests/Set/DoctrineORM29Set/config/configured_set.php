<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

use Rector\Core\ValueObject\PhpVersionFeature;
use Rector\Doctrine\Set\DoctrineSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->sets([__DIR__ . '/../../../../config/config.php', DoctrineSetList::DOCTRINE_ORM_29]);

    $rectorConfig->phpVersion(PhpVersionFeature::NEW_INITIALIZERS - 1);
};
