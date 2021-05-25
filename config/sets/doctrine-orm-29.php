<?php

declare(strict_types=1);

use Rector\Php80\Rector\Class_\AnnotationToAttributeRector;
use Rector\Php80\ValueObject\AnnotationToAttribute;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\SymfonyPhpConfig\ValueObjectInliner;
use Rector\Core\Configuration\Option;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::AUTO_IMPORT_NAMES, true);

    $services = $containerConfigurator->services();

    $services->set(AnnotationToAttributeRector::class)
        ->call('configure', [[
            AnnotationToAttributeRector::ANNOTATION_TO_ATTRIBUTE => ValueObjectInliner::inline(
                [
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\Table', 'Doctrine\ORM\Mapping\Table'),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\Entity', 'Doctrine\ORM\Mapping\Entity'),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\Id', 'Doctrine\ORM\Mapping\Id'),
                    new AnnotationToAttribute(
                        'Doctrine\ORM\Mapping\GeneratedValue',
                        'Doctrine\ORM\Mapping\GeneratedValue'
                    ),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\Column', 'Doctrine\ORM\Mapping\Column'),
                ]
            ),
        ]]);
};
