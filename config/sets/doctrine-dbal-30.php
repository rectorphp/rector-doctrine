<?php

declare(strict_types=1);

use PHPStan\Type\VoidType;
use Rector\Renaming\Rector\MethodCall\RenameMethodRector;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Renaming\ValueObject\MethodCallRename;
use Rector\TypeDeclaration\Rector\ClassMethod\AddReturnTypeDeclarationRector;
use Rector\TypeDeclaration\ValueObject\AddReturnTypeDeclaration;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

# https://github.com/doctrine/dbal/blob/master/UPGRADE.md#bc-break-changes-in-handling-string-and-binary-columns
return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(RenameMethodRector::class)
        ->configure([
            new MethodCallRename(
                'Doctrine\DBAL\Platforms\AbstractPlatform',
                'getVarcharTypeDeclarationSQL',
                'getStringTypeDeclarationSQL'
            ),
            new MethodCallRename('Doctrine\DBAL\Driver\DriverException', 'getErrorCode', 'getCode'),
        ]);

    $services->set(AddReturnTypeDeclarationRector::class)
        ->configure([new AddReturnTypeDeclaration('Doctrine\DBAL\Connection', 'ping', new VoidType())]);

    # https://github.com/doctrine/dbal/blob/master/UPGRADE.md#deprecated-abstractionresult
    $services->set(RenameClassRector::class)
        ->configure([
            'Doctrine\DBAL\Abstraction\Result' => 'Doctrine\DBAL\Result',
        ]);
};
