<?php

declare(strict_types=1);

use Rector\Doctrine\NodeAnalyzer\AttrinationFinder;
use Rector\Core\Configuration\Option;
use Rector\Php55\Rector\String_\StringClassNameToClassConstantRector;
use Rector\Php74\Rector\Property\TypedPropertyRector;
use Rector\Php80\Rector\Class_\ClassPropertyAssignToConstructorPromotionRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

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

    $containerConfigurator->import(LevelSetList::UP_TO_PHP_81);
    $containerConfigurator->import(SetList::DEAD_CODE);
    $containerConfigurator->import(SetList::CODE_QUALITY);

    $services = $containerConfigurator->services();
    $services->set(StringClassNameToClassConstantRector::class)
        ->configure([
            'Doctrine\*',
            'Gedmo\*',
            'Knp\*',
            'DateTime',
            'DateTimeInterface',
        ]);

    /**
     * Avoid error
     *
     *  [ERROR] Cannot autowire service
     *    "Rector\Symfony\NodeAnalyzer\RouteRequiredParamNameToTypesResolver":
     *    argument "$attrinationFinder" of method "__construct()" references
     *    class "Rector\Doctrine\NodeAnalyzer\AttrinationFinder" but no such
     *     service exists.
     *
     *  When run rectify:
     *
     *      vendor/bin/rector process --ansi
     *
     *  at https://github.com/rectorphp/rector-doctrine package
     */
    $services->set(AttrinationFinder::class);
};
