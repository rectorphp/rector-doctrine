<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\Orm30\Rector\MethodCall\SetParametersArrayToCollectionRector;
use Rector\Renaming\Rector\Name\RenameClassRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rules([
        SetParametersArrayToCollectionRector::class,
    ]);

    $rectorConfig->ruleWithConfiguration(RenameClassRector::class, [
        'Doctrine\ORM\ORMException' => 'Doctrine\ORM\Exception\ORMException',
    ]);
};
