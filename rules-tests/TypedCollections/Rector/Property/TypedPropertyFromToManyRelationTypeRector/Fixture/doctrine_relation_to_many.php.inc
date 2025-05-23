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
     */
    private \Doctrine\Common\Collections\Collection $cars;

    #[ORM\OneToMany(targetEntity: "App\Product")]
    private \Doctrine\Common\Collections\Collection $items;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->cars = new ArrayCollection();
    }
}

?>
