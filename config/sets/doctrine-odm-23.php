<?php

declare(strict_types=1);

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Rector\Php80\Rector\Class_\AnnotationToAttributeRector;
use Rector\Php80\ValueObject\AnnotationToAttribute;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\SymfonyPhpConfig\ValueObjectInliner;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(AnnotationToAttributeRector::class)
        ->call('configure', [[
            AnnotationToAttributeRector::ANNOTATION_TO_ATTRIBUTE => ValueObjectInliner::inline([
                new AnnotationToAttribute(MongoDB\AlsoLoad::class),
                new AnnotationToAttribute(MongoDB\ChangeTrackingPolicy::class),
                new AnnotationToAttribute(MongoDB\DefaultDiscriminatorValue::class),
                new AnnotationToAttribute(MongoDB\DiscriminatorField::class),
                new AnnotationToAttribute(MongoDB\DiscriminatorMap::class),
                new AnnotationToAttribute(MongoDB\DiscriminatorValue::class),
                new AnnotationToAttribute(MongoDB\Document::class),
                new AnnotationToAttribute(MongoDB\EmbeddedDocument::class),
                new AnnotationToAttribute(MongoDB\EmbedMany::class),
                new AnnotationToAttribute(MongoDB\EmbedOne::class),
                new AnnotationToAttribute(MongoDB\Field::class),
                new AnnotationToAttribute(MongoDB\File::class),
                new AnnotationToAttribute(MongoDB\File\ChunkSize::class),
                new AnnotationToAttribute(MongoDB\File\Filename::class),
                new AnnotationToAttribute(MongoDB\File\Length::class),
                new AnnotationToAttribute(MongoDB\File\Metadata::class),
                new AnnotationToAttribute(MongoDB\File\UploadDate::class),
                new AnnotationToAttribute(MongoDB\HasLifecycleCallbacks::class),
                new AnnotationToAttribute(MongoDB\Id::class),
                new AnnotationToAttribute(MongoDB\Index::class),
                new AnnotationToAttribute(MongoDB\Indexes::class),
                new AnnotationToAttribute(MongoDB\InheritanceType::class),
                new AnnotationToAttribute(MongoDB\Lock::class),
                new AnnotationToAttribute(MongoDB\MappedSuperclass::class),
                new AnnotationToAttribute(MongoDB\PostLoad::class),
                new AnnotationToAttribute(MongoDB\PostPersist::class),
                new AnnotationToAttribute(MongoDB\PostRemove::class),
                new AnnotationToAttribute(MongoDB\PostUpdate::class),
                new AnnotationToAttribute(MongoDB\PreFlush::class),
                new AnnotationToAttribute(MongoDB\PreLoad::class),
                new AnnotationToAttribute(MongoDB\PrePersist::class),
                new AnnotationToAttribute(MongoDB\PreRemove::class),
                new AnnotationToAttribute(MongoDB\PreUpdate::class),
                new AnnotationToAttribute(MongoDB\QueryResultDocument::class),
                new AnnotationToAttribute(MongoDB\ReadPreference::class),
                new AnnotationToAttribute(MongoDB\ReferenceMany::class),
                new AnnotationToAttribute(MongoDB\ReferenceOne::class),
                new AnnotationToAttribute(MongoDB\ShardKey::class),
                new AnnotationToAttribute(MongoDB\UniqueIndex::class),
                new AnnotationToAttribute(MongoDB\Validation::class),
                new AnnotationToAttribute(MongoDB\Version::class),
                new AnnotationToAttribute(MongoDB\View::class),
            ]),
        ]]);
};
