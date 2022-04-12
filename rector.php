<?php

declare(strict_types=1);
use Rector\Config\RectorConfig;
use Rector\Core\Configuration\Option;
use Rector\Php55\Rector\String_\StringClassNameToClassConstantRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->import(__DIR__ . '/config/config.php');

    $parameters = $rectorConfig->parameters();

    $parameters->set(Option::AUTO_IMPORT_NAMES, true);
    $parameters->set(Option::PATHS, [
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    $parameters->set(Option::PARALLEL, true);

    $parameters->set(Option::SKIP, [
        // for tests
        '*/Source/*',
        '*/Fixture/*',
    ]);

    $rectorConfig->import(LevelSetList::UP_TO_PHP_81);
    $rectorConfig->import(SetList::DEAD_CODE);
    $rectorConfig->import(SetList::CODE_QUALITY);
    $rectorConfig->import(SetList::NAMING);

    $services = $rectorConfig->services();
    $services->set(StringClassNameToClassConstantRector::class)
        ->configure([
            'Doctrine\*',
            'Gedmo\*',
            'Knp\*',
            'DateTime',
            'DateTimeInterface',
        ]);
};
