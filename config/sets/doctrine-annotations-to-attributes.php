<?php

declare(strict_types=1);

use Rector\Php80\Rector\Class_\AnnotationToAttributeRector;
use Rector\Php80\ValueObject\AnnotationToAttribute;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(AnnotationToAttributeRector::class)
        ->configure([
            new AnnotationToAttribute('Doctrine\ORM\Mapping\Table'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\Entity'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\Column'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\Id'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\GeneratedValue'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\OneToOne'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\ManyToMany'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\JoinTable'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\ManyToOne'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\JoinColumns'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\JoinColumn'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\InverseJoinColumn'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\OneToMany'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\UniqueConstraint'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\SequenceGenerator'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\OrderBy'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\Index'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\CustomIdGenerator'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\Embeddable'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\Embedded'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\MappedSuperclass'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\InheritanceType'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\DiscriminatorColumn'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\DiscriminatorMap'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\Version'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\ChangeTrackingPolicy'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\HasLifecycleCallbacks'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\PostLoad'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\PostPersist'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\PostRemove'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\PostUpdate'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\PrePersist'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\PreRemove'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\PreUpdate'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\Cache'),
            new AnnotationToAttribute('Doctrine\ORM\Mapping\EntityListeners'),
        ]);
};
