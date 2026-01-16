<?php

declare(strict_types=1);

namespace Rector\Doctrine\Enum;

final class MappingClass
{
    public const string COLUMN = 'Doctrine\ORM\Mapping\Column';

    public const string TABLE = 'Doctrine\ORM\Mapping\Table';

    public const string ENTITY = 'Doctrine\ORM\Mapping\Entity';

    public const string EMBEDDABLE = 'Doctrine\ORM\Mapping\Embeddable';

    public const string DISCRIMINATOR_MAP = 'Doctrine\ORM\Mapping\DiscriminatorMap';

    public const string INHERITANCE_TYPE = 'Doctrine\ORM\Mapping\InheritanceType';

    public const string DISCRIMINATOR_COLUMN = 'Doctrine\ORM\Mapping\DiscriminatorColumn';

    public const string EMBEDDED = 'Doctrine\ORM\Mapping\Embedded';

    public const string GEDMO_SOFT_DELETEABLE = 'Gedmo\Mapping\Annotation\SoftDeleteable';

    public const string GEDMO_TIMESTAMPABLE = 'Gedmo\Mapping\Annotation\Timestampable';

    public const string ID = 'Doctrine\ORM\Mapping\Id';

    public const string GENERATED_VALUE = 'Doctrine\ORM\Mapping\GeneratedValue';

    public const string INDEX = 'Doctrine\ORM\Mapping\Index';

    public const string INVERSE_JOIN_COLUMN = 'Doctrine\ORM\Mapping\InverseJoinColumn';

    public const string JOIN_TABLE = 'Doctrine\ORM\Mapping\JoinTable';

    public const string MANY_TO_MANY = 'Doctrine\ORM\Mapping\ManyToMany';

    public const string MANY_TO_ONE = 'Doctrine\ORM\Mapping\ManyToOne';

    public const string JOIN_COLUMN = 'Doctrine\ORM\Mapping\JoinColumn';

    public const string ORDER_BY = 'Doctrine\ORM\Mapping\OrderBy';

    public const string ONE_TO_MANY = 'Doctrine\ORM\Mapping\OneToMany';

    public const string ONE_TO_ONE = 'Doctrine\ORM\Mapping\OneToOne';

    public const string UNIQUE_CONSTRAINT = 'Doctrine\ORM\Mapping\UniqueConstraint';
}
