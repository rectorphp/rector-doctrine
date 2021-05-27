<?php
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;

class Product
{
    /**
     * @OneToOne(targetEntity="Shipment")
     * @JoinColumn(name="shipment_id", referencedColumnName="id")
     */
    private $shipment;
}

?>
-----
<?php
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;

class Product
{
    #[\Doctrine\ORM\Mapping\OneToOne(targetEntity: 'Shipment')]
    #[\Doctrine\ORM\Mapping\JoinColumn(name: 'shipment_id', referencedColumnName: 'id')]
    private $shipment;
}

?>
