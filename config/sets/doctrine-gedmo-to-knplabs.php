<?php

declare(strict_types=1);

use Rector\Doctrine\Rector\Class_\BlameableBehaviorRector;
use Rector\Doctrine\Rector\Class_\LoggableBehaviorRector;
use Rector\Doctrine\Rector\Class_\SluggableBehaviorRector;
use Rector\Doctrine\Rector\Class_\SoftDeletableBehaviorRector;
use Rector\Doctrine\Rector\Class_\TimestampableBehaviorRector;
use Rector\Doctrine\Rector\Class_\TranslationBehaviorRector;
use Rector\Doctrine\Rector\Class_\TreeBehaviorRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

# version gedmo/doctrine-extensions 2.x to knplabs/doctrine-behaviors 2.0
return static function (\Rector\Config\RectorConfig $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(TimestampableBehaviorRector::class);
    $services->set(SluggableBehaviorRector::class);
    $services->set(TreeBehaviorRector::class);
    $services->set(TranslationBehaviorRector::class);
    $services->set(SoftDeletableBehaviorRector::class);
    $services->set(BlameableBehaviorRector::class);
    $services->set(LoggableBehaviorRector::class);
};
