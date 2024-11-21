<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

/**
 * @based https://github.com/rectorphp/rector-doctrine/commit/0d977cee73a68465c14b4b1142066cdca4aaedc7}
 *
 * @see https://tomasvotruba.com/blog/how-to-flip-doctrine-odm-repositories-to-services
 * @see https://tomasvotruba.com/blog/2017/10/16/how-to-use-repository-with-doctrine-as-service-in-symfony
 * @see https://tomasvotruba.com/blog/2018/04/02/rectify-turn-repositories-to-services-in-symfony/
 * @see https://getrector.com/blog/2021/02/08/how-to-instantly-decouple-symfony-doctrine-repository-inheritance-to-clean-composition
 */
return RectorConfig::configure()
    ->withRules([
        \Rector\Doctrine\RepositoryService\Rector\Class_\MoveRepositoryFromParentToConstructorRector::class,
        \Rector\Doctrine\RepositoryService\Rector\MethodCall\ReplaceParentRepositoryCallsByRepositoryPropertyRector::class,
        \Rector\Doctrine\RepositoryService\Rector\Class_\RemoveRepositoryFromEntityAnnotationRector::class,
        // covers "extends ServiceEntityRepository"
        // @see https://github.com/doctrine/DoctrineBundle/pull/727/files
        \Rector\Doctrine\RepositoryService\Rector\ClassMethod\ServiceEntityRepositoryParentCallToDIRector::class,
    ]);
