<?php
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\JoinColumn;

class JoinColumnOneToOne
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

class JoinColumnOneToOne
{
    #[OneToOne(targetEntity: 'Shipment')]
    #[JoinColumn(name: 'shipment_id', referencedColumnName: 'id')]
    private $shipment;
}

?>
