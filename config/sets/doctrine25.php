<?php

declare(strict_types=1);

use PHPStan\Type\ObjectType;

use Rector\Config\RectorConfig;
use Rector\Removing\Rector\ClassMethod\ArgumentRemoverRector;
use Rector\Removing\ValueObject\ArgumentRemover;
use Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeDeclarationRector;
use Rector\TypeDeclaration\ValueObject\AddParamTypeDeclaration;

return static function (RectorConfig $containerConfigurator): void {
    $services = $containerConfigurator->services();
    $services->set(AddParamTypeDeclarationRector::class)
        ->configure([
            new AddParamTypeDeclaration(
                'Doctrine\ORM\Mapping\ClassMetadataFactory',
                'setEntityManager',
                0,
                new ObjectType('Doctrine\ORM\EntityManagerInterface')
            ),
            new AddParamTypeDeclaration(
                'Doctrine\ORM\Tools\DebugUnitOfWorkListener',
                'dumpIdentityMap',
                0,
                new ObjectType('Doctrine\ORM\EntityManagerInterface')
            ),
        ]);

    $services->set(ArgumentRemoverRector::class)
        ->configure([
            new ArgumentRemover(
                'Doctrine\ORM\Persisters\Entity\AbstractEntityInheritancePersister',
                'getSelectJoinColumnSQL',
                4,
                null
            ),
        ]);
};
