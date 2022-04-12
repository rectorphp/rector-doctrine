<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

use Rector\Core\Configuration\Option;
use Rector\Core\ValueObject\PhpVersionFeature;
use Rector\Doctrine\Rector\Property\TypedPropertyFromToManyRelationTypeRector;

return static function (RectorConfig $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/../../../../../config/config.php');

    $services = $containerConfigurator->services();
    $services->set(TypedPropertyFromToManyRelationTypeRector::class);

    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PHP_VERSION_FEATURES, PhpVersionFeature::UNION_TYPES);
};
