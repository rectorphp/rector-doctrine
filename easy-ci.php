<?php

declare(strict_types=1);

use Rector\Doctrine\Rector\Class_\ClassAnnotationToNamedArgumentConstructorRector;
use Rector\Doctrine\Rector\MethodCall\ChangeSetParametersArrayToArrayCollectionRector;
use Rector\Doctrine\Rector\MethodCall\EntityAliasToClassConstantReferenceRector;
use Rector\Doctrine\Rector\Property\DoctrineTargetEntityStringToClassConstantRector;
use Symplify\EasyCI\Config\EasyCIConfig;

return static function (EasyCIConfig $easyCIConfig): void {
    $easyCIConfig->paths([__DIR__ . '/config', __DIR__ . '/src', __DIR__ . '/rules']);

    $easyCIConfig->typesToSkip([
        \Rector\Core\Contract\Rector\RectorInterface::class,
    ]);
};
