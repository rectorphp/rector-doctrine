<?php

namespace Rector\Doctrine\Tests\Set\DoctrineODM23Set\Fixture;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Product
{
    /**
     * @MongoDB\ReferenceMany(targetDocument=Feature::class, mappedBy="product")
     */
    private $features;
}

class Feature
{
    /**
     * @MongoDB\ReferenceOne(targetDocument=Product::class, storeAs="id", name="productId")
     */
    private $product;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\DoctrineODM23Set\Fixture;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

#[\Doctrine\ODM\MongoDB\Mapping\Annotations\Document]
class Product
{
    #[\Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany(targetDocument: Feature::class, mappedBy: 'product')]
    private $features;
}

class Feature
{
    #[\Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceOne(targetDocument: Product::class, storeAs: 'id', name: 'productId')]
    private $product;
}

?>
