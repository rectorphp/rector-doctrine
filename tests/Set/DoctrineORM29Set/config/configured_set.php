<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\Set\DoctrineSetList;
use Rector\ValueObject\PhpVersionFeature;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->sets([DoctrineSetList::DOCTRINE_ORM_29]);

    $rectorConfig->phpVersion(PhpVersionFeature::NEW_INITIALIZERS - 1);
};
