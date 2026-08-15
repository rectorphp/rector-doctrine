<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\Dbal31\Rector\MethodCall\QueryBuilderExecuteToExecuteQueryOrExecuteStatementRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(QueryBuilderExecuteToExecuteQueryOrExecuteStatementRector::class);
};
