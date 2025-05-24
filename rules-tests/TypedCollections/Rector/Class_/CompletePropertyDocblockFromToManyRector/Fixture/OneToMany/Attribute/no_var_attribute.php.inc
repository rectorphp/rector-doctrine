<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Fixture\OneToMany\Attribute;

use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\Training;

#[ORM\Entity]
class NoVar
{
    #[ORM\OneToMany(targetEntity:Training::class, mappedBy:"trainer")]
    private $trainings = [];
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Fixture\OneToMany\Attribute;

use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\Training;

#[ORM\Entity]
class NoVar
{
    /**
     * @var \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source\Training>
     */
    #[ORM\OneToMany(targetEntity:Training::class, mappedBy:"trainer")]
    private $trainings = [];
}

?>
