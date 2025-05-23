<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

class DoctrineRelationToMany
{
    /**
     * @ORM\OneToMany(targetEntity="App\Product")
     */
    private $products;

    /**
     * @ORM\ManyToMany(targetEntity="App\Car")
     */
    private $cars;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->cars = new ArrayCollection();
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

class DoctrineRelationToMany
{
    /**
     * @ORM\OneToMany(targetEntity="App\Product")
     * @var \Doctrine\Common\Collections\Collection<int, \App\Product>
     */
    private \Doctrine\Common\Collections\Collection $products;

    /**
     * @ORM\ManyToMany(targetEntity="App\Car")
     * @var \Doctrine\Common\Collections\Collection<int, \App\Car>
     */
    private \Doctrine\Common\Collections\Collection $cars;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->cars = new ArrayCollection();
    }
}

?>
