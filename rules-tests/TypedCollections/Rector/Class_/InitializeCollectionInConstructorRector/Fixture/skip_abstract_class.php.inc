<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\InitializeCollectionInConstructorRector\Fixture;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity]
abstract class SkipAbstractClass
{
    #[OneToMany(targetEntity: 'SomeClass')]
    private $items = [];
}
