<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\Dbal211\Rector\MethodCall\ExtractArrayArgOnQueryBuilderSelectRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(ExtractArrayArgOnQueryBuilderSelectRector::class);
};
