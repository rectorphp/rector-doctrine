<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\CodeQuality\Rector\Namespace_\NamespaceAliasRector;
use Rector\Doctrine\CodeQuality\ValueObject\NamespaceAlias;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->ruleWithConfiguration(NamespaceAliasRector::class, [
        new NamespaceAlias('Doctrine\\ORM\\Mapping', 'ORM'),
        new NamespaceAlias('Doctrine\\ODM\\MongoDB\\Mapping\\Attribute', 'ODM'),
    ]);
};
