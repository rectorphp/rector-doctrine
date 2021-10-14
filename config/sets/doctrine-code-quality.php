<?php

declare(strict_types=1);

use Rector\Doctrine\Rector\Class_\InitializeDefaultEntityCollectionRector;
use Rector\Doctrine\Rector\Class_\ManagerRegistryGetManagerToEntityManagerRector;
use Rector\Doctrine\Rector\Class_\MoveCurrentDateTimeDefaultInEntityToConstructorRector;
use Rector\Doctrine\Rector\Class_\RemoveRedundantDefaultClassAnnotationValuesRector;
use Rector\Doctrine\Rector\ClassMethod\MakeEntitySetterNullabilityInSyncWithPropertyRector;
use Rector\Doctrine\Rector\Property\ChangeBigIntEntityPropertyToIntTypeRector;
use Rector\Doctrine\Rector\Property\CorrectDefaultTypesOnEntityPropertyRector;
use Rector\Doctrine\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector;
use Rector\Doctrine\Rector\Property\MakeEntityDateTimePropertyDateTimeInterfaceRector;
use Rector\Doctrine\Rector\Property\RemoveRedundantDefaultPropertyAnnotationValuesRector;
use Rector\Privatization\Rector\MethodCall\ReplaceStringWithClassConstantRector;
use Rector\Privatization\ValueObject\ReplaceStringWithClassConstant;
use Rector\Transform\Rector\Attribute\AttributeKeyToClassConstFetchRector;
use Rector\Transform\Rector\MethodCall\ServiceGetterToConstructorInjectionRector;
use Rector\Transform\ValueObject\AttributeKeyToClassConstFetch;
use Rector\Transform\ValueObject\ServiceGetterToConstructorInjection;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\SymfonyPhpConfig\ValueObjectInliner;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();
    $services->set(ManagerRegistryGetManagerToEntityManagerRector::class);
    $services->set(InitializeDefaultEntityCollectionRector::class);
    $services->set(MakeEntitySetterNullabilityInSyncWithPropertyRector::class);
    $services->set(MakeEntityDateTimePropertyDateTimeInterfaceRector::class);
    $services->set(MoveCurrentDateTimeDefaultInEntityToConstructorRector::class);
    $services->set(CorrectDefaultTypesOnEntityPropertyRector::class);
    $services->set(ChangeBigIntEntityPropertyToIntTypeRector::class);
    $services->set(ImproveDoctrineCollectionDocTypeInEntityRector::class);
    $services->set(RemoveRedundantDefaultPropertyAnnotationValuesRector::class);
    $services->set(RemoveRedundantDefaultClassAnnotationValuesRector::class);

    $services = $containerConfigurator->services();
    $services->set(AttributeKeyToClassConstFetchRector::class)
        ->call('configure', [[
            AttributeKeyToClassConstFetchRector::ATTRIBUTE_KEYS_TO_CLASS_CONST_FETCHES => ValueObjectInliner::inline([
                new AttributeKeyToClassConstFetch('Doctrine\ORM\Mapping\Column', 'type', 'Doctrine\DBAL\Types\Types', [
                    'array' => 'ARRAY',
                    'ascii_string' => 'ASCII_STRING',
                    'bigint' => 'BIGINT',
                    'binary' => 'BINARY',
                    'blob' => 'BLOB',
                    'boolean' => 'BOOLEAN',
                    'date' => 'DATE_MUTABLE',
                    'date_immutable' => 'DATE_IMMUTABLE',
                    'dateinterval' => 'DATEINTERVAL',
                    'datetime' => 'DATETIME_MUTABLE',
                    'datetime_immutable' => 'DATETIME_IMMUTABLE',
                    'datetimetz' => 'DATETIMETZ_MUTABLE',
                    'datetimetz_immutable' => 'DATETIMETZ_IMMUTABLE',
                    'decimal' => 'DECIMAL',
                    'float' => 'FLOAT',
                    'guid' => 'GUID',
                    'integer' => 'INTEGER',
                    'json' => 'JSON',
                    'object' => 'OBJECT',
                    'simple_array' => 'SIMPLE_ARRAY',
                    'smallint' => 'SMALLINT',
                    'string' => 'STRING',
                    'text' => 'TEXT',
                    'time' => 'TIME_MUTABLE',
                    'time_immutable' => 'TIME_IMMUTABLE',
                ]),
            ]),
        ]]);

    $services->set(ReplaceStringWithClassConstantRector::class)
        ->call('configure', [[
            ReplaceStringWithClassConstantRector::REPLACE_STRING_WITH_CLASS_CONSTANT => ValueObjectInliner::inline([
                new ReplaceStringWithClassConstant(
                    'Doctrine\ORM\QueryBuilder',
                    'orderBy',
                    1,
                    'Doctrine\Common\Collections\Criteria'
                ),
                new ReplaceStringWithClassConstant(
                    'Doctrine\ORM\QueryBuilder',
                    'addOrderBy',
                    1,
                    'Doctrine\Common\Collections\Criteria'
                ),
            ]),
        ]]);

    $services->set(ServiceGetterToConstructorInjectionRector::class)
        ->call('configure', [[
            ServiceGetterToConstructorInjectionRector::METHOD_CALL_TO_SERVICES => ValueObjectInliner::inline([
                new ServiceGetterToConstructorInjection(
                    'Doctrine\Common\Persistence\ManagerRegistry',
                    'getConnection',
                    'Doctrine\DBAL\Connection'
                ),
                new ServiceGetterToConstructorInjection(
                    'Doctrine\ORM\EntityManagerInterface',
                    'getConfiguration',
                    'Doctrine\ORM\Configuration'
                ),
            ]),
        ]]);
};
