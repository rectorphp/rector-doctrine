<?php

namespace Rector\Tests\Doctrine\Rector\Property\RemoveRedundantDefaultPropertyAnnotationValuesRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Teste.
 *
 * @ORM\Entity()
 */
class SkipJoinCOlumnsWIthArrayOfOfJoinColumn
{
    /**
     * @var InventoryLocation
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\InventoryLocation", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="inventory_location_id", referencedColumnName="id")
     * })
     */
    private $inventoryLocation;

    public function getInventoryLocation(): ?InventoryLocation
    {
        return $this->inventoryLocation;
    }

    public function setInventoryLocation(?InventoryLocation $inventoryLocation): self
    {
        $this->inventoryLocation = $inventoryLocation;

        return $this;
    }
}
?>
