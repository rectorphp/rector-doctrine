<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\ClassLike\RemoveAnnotationRector;
use Rector\Doctrine\Rector\Class_\MoveRepositoryFromParentToConstructorRector;
use Rector\Doctrine\Rector\Class_\RemoveRepositoryFromEntityAnnotationRector;
use Rector\Doctrine\Rector\ClassMethod\ServiceEntityRepositoryParentCallToDIRector;
use Rector\Doctrine\Rector\MethodCall\ReplaceParentRepositoryCallsByRepositoryPropertyRector;
use Rector\Removing\Rector\Class_\RemoveParentRector;
use Rector\Renaming\Rector\PropertyFetch\RenamePropertyRector;
use Rector\Renaming\ValueObject\RenameProperty;
use Rector\Transform\Rector\MethodCall\MethodCallToPropertyFetchRector;
use Rector\Transform\Rector\MethodCall\ReplaceParentCallByPropertyCallRector;
use Rector\Transform\ValueObject\MethodCallToPropertyFetch;
use Rector\Transform\ValueObject\ReplaceParentCallByPropertyCall;

/**
 * @see https://tomasvotruba.com/blog/2017/10/16/how-to-use-repository-with-doctrine-as-service-in-symfony/
 * @see https://tomasvotruba.com/blog/2018/04/02/rectify-turn-repositories-to-services-in-symfony/
 * @see https://getrector.org/blog/2021/02/08/how-to-instantly-decouple-symfony-doctrine-repository-inheritance-to-clean-composition
 */
return static function (RectorConfig $rectorConfig): void {
    $services = $rectorConfig->services();

    # order matters, this needs to be first to correctly detect parent repository

    // covers "extends EntityRepository"
    $services->set(MoveRepositoryFromParentToConstructorRector::class);
    $services->set(ReplaceParentRepositoryCallsByRepositoryPropertyRector::class);
    $services->set(RemoveRepositoryFromEntityAnnotationRector::class);

    // covers "extends ServiceEntityRepository"
    // @see https://github.com/doctrine/DoctrineBundle/pull/727/files
    $services->set(ServiceEntityRepositoryParentCallToDIRector::class);

    $services->set(RenamePropertyRector::class)
        ->configure([
            new RenameProperty(
                'Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository',
                '_em',
                'entityManager'
            ),
        ]);

    $services->set(RemoveAnnotationRector::class)
        ->configure(['method']);

    $services->set(ReplaceParentCallByPropertyCallRector::class)
        ->configure([
            new ReplaceParentCallByPropertyCall(
                'Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository',
                'createQueryBuilder',
                'entityRepository'
            ),
            new ReplaceParentCallByPropertyCall(
                'Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository',
                'createResultSetMappingBuilder',
                'entityRepository'
            ),
            new ReplaceParentCallByPropertyCall(
                'Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository',
                'clear',
                'entityRepository'
            ),
            new ReplaceParentCallByPropertyCall(
                'Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository',
                'find',
                'entityRepository'
            ),
            new ReplaceParentCallByPropertyCall(
                'Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository',
                'findBy',
                'entityRepository'
            ),
            new ReplaceParentCallByPropertyCall(
                'Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository',
                'findAll',
                'entityRepository'
            ),
            new ReplaceParentCallByPropertyCall(
                'Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository',
                'count',
                'entityRepository'
            ),
            new ReplaceParentCallByPropertyCall(
                'Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository',
                'getClassName',
                'entityRepository'
            ),
            new ReplaceParentCallByPropertyCall(
                'Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository',
                'matching',
                'entityRepository'
            ),
        ]);

    // @@todo
    $services->set(MethodCallToPropertyFetchRector::class)
        ->configure([
            new MethodCallToPropertyFetch(
                'Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository',
                'getEntityManager',
                'entityManager'
            ),
        ]);

    $services->set(RemoveParentRector::class)
        ->configure(['Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository']);
};
