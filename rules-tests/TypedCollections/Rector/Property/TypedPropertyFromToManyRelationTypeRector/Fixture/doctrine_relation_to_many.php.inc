<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

class DoctrineRelationToMany
{
    /**
     * @ORM\ManyToMany(targetEntity="App\Car")
     */
    private $cars;

    #[ORM\OneToMany(targetEntity: "App\Product")]
    private $items;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->cars = new ArrayCollection();
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

class DoctrineRelationToMany
{
    /**
     * @ORM\ManyToMany(targetEntity="App\Car")
     * @var \Doctrine\Common\Collections\Collection<int, \App\Car>
     */
    private \Doctrine\Common\Collections\Collection $cars;

    /**
     * @var \Doctrine\Common\Collections\Collection<int, \App\Product>
     */
    #[ORM\OneToMany(targetEntity: "App\Product")]
    private \Doctrine\Common\Collections\Collection $items;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->cars = new ArrayCollection();
    }
}

?>
