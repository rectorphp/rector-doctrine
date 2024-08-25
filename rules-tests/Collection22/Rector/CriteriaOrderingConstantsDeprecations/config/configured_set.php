<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\Collection22\Rector\CriteriaOrderingConstantsDeprecationRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(CriteriaOrderingConstantsDeprecationRector::class);
};
