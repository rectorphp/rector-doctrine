<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\Dbal40\Rector\StmtsAwareInterface\ExecuteQueryParamsToBindValueRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ExecuteQueryParamsToBindValueRector::class);
};
