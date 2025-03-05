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
    #[JoinColumn(name: 'shipment_id', referencedColumnName: 'id')]
    #[OneToOne(targetEntity: \Shipment::class)]
    private $shipment;
}

?>
