<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\ValueObject\MethodCallRename;

return static function (RectorConfig $rectorConfig): void {
    // @see https://github.com/doctrine/orm/pull/12022 on PHP 8.4 use new functions
    if (PHP_VERSION_ID >= 80400) {
        $rectorConfig->ruleWithConfiguration(
            RenameMethodRector::class,
            [
                new MethodCallRename('Doctrine\ORM\ORMSetup', 'createAttributeMetadataConfiguration', 'createAttributeMetadataConfig'),
                new MethodCallRename('Doctrine\ORM\ORMSetup', 'createXMLMetadataConfiguration', 'createXMLMetadataConfig'),
                new MethodCallRename('Doctrine\ORM\ORMSetup', 'createConfiguration', 'createConfig'),
            ],
        );
    }
};
