<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

use Rector\Doctrine\Rector\Class_\AddEntityIdByConditionRector;

use Rector\Doctrine\Tests\ConfigList;
use Rector\Doctrine\Tests\Rector\Class_\AddEntityIdByConditionRector\Source\SomeTrait;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(ConfigList::MAIN);

    $rectorConfig->ruleWithConfiguration(AddEntityIdByConditionRector::class, [SomeTrait::class]);
};
