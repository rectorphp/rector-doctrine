<?php

declare(strict_types=1);

use Rector\Php80\Rector\Class_\AnnotationToAttributeRector;
use Rector\Php80\ValueObject\AnnotationToAttribute;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\SymfonyPhpConfig\ValueObjectInliner;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $services = $containerConfigurator->services();

    $services->set(AnnotationToAttributeRector::class)
        ->call('configure', [[
            AnnotationToAttributeRector::ANNOTATION_TO_ATTRIBUTE => ValueObjectInliner::inline(
                [
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\Table', 'Doctrine\ORM\Mapping\Table'),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\Entity', 'Doctrine\ORM\Mapping\Entity'),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\Column', 'Doctrine\ORM\Mapping\Column'),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\Id', 'Doctrine\ORM\Mapping\Id'),
                    new AnnotationToAttribute(
                        'Doctrine\ORM\Mapping\GeneratedValue',
                        'Doctrine\ORM\Mapping\GeneratedValue'
                    ),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\OneToOne', 'Doctrine\ORM\Mapping\OneToOne'),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\ManyToMany', 'Doctrine\ORM\Mapping\ManyToMany'),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\JoinTable', 'Doctrine\ORM\Mapping\JoinTable'),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\ManyToOne', 'Doctrine\ORM\Mapping\ManyToOne'),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\JoinColumn', 'Doctrine\ORM\Mapping\JoinColumn'),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\OneToMany', 'Doctrine\ORM\Mapping\OneToMany'),
                    new AnnotationToAttribute(
                        'Doctrine\ORM\Mapping\UniqueConstraint',
                        'Doctrine\ORM\Mapping\UniqueConstraint'
                    ),
                    new AnnotationToAttribute(
                        'Doctrine\ORM\Mapping\SequenceGenerator',
                        'Doctrine\ORM\Mapping\SequenceGenerator'
                    ),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\OrderBy', 'Doctrine\ORM\Mapping\OrderBy'),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\Index', 'Doctrine\ORM\Mapping\Index'),
                    new AnnotationToAttribute(
                        'Doctrine\ORM\Mapping\CustomIdGenerator',
                        'Doctrine\ORM\Mapping\CustomIdGenerator'
                    ),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\Embeddable', 'Doctrine\ORM\Mapping\Embeddable'),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\Embedded', 'Doctrine\ORM\Mapping\Embedded'),
                    new AnnotationToAttribute(
                        'Doctrine\ORM\Mapping\MappedSuperclass',
                        'Doctrine\ORM\Mapping\MappedSuperclass'
                    ),
                    new AnnotationToAttribute(
                        'Doctrine\ORM\Mapping\InheritanceType',
                        'Doctrine\ORM\Mapping\InheritanceType'
                    ),
                    new AnnotationToAttribute(
                        'Doctrine\ORM\Mapping\DiscriminatorColumn',
                        'Doctrine\ORM\Mapping\DiscriminatorColumn'
                    ),
                    new AnnotationToAttribute(
                        'Doctrine\ORM\Mapping\DiscriminatorMap',
                        'Doctrine\ORM\Mapping\DiscriminatorMap'
                    ),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\Version', 'Doctrine\ORM\Mapping\Version'),
                    new AnnotationToAttribute(
                        'Doctrine\ORM\Mapping\ChangeTrackingPolicy',
                        'Doctrine\ORM\Mapping\ChangeTrackingPolicy'
                    ),
                    new AnnotationToAttribute(
                        'Doctrine\ORM\Mapping\HasLifecycleCallbacks',
                        'Doctrine\ORM\Mapping\HasLifecycleCallbacks'
                    ),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\PostLoad', 'Doctrine\ORM\Mapping\PostLoad'),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\PostPersist', 'Doctrine\ORM\Mapping\PostPersist'),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\PostRemove', 'Doctrine\ORM\Mapping\PostRemove'),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\PostUpdate', 'Doctrine\ORM\Mapping\PostUpdate'),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\PrePersist', 'Doctrine\ORM\Mapping\PrePersist'),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\PreRemove', 'Doctrine\ORM\Mapping\PreRemove'),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\PreUpdate', 'Doctrine\ORM\Mapping\PreUpdate'),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\Cache', 'Doctrine\ORM\Mapping\Cache'),
                    new AnnotationToAttribute('Doctrine\ORM\Mapping\JoinColumns', 'Doctrine\ORM\Mapping\JoinColumns'),
                ]
            ),
        ]]);
};
