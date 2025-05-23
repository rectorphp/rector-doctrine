<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\ExplicitRelationCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity]
class SkipAlreadyAssigned
{
    #[OneToMany(targetEntity: 'SomeClass')]
    private $items = [];
    public function __construct()
    {
        $this->items = new ArrayCollection();
    }
}
