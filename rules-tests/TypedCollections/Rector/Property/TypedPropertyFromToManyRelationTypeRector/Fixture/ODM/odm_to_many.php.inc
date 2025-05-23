<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Fixture\ODM;

use Doctrine\Common\Collections\ArrayCollection;
use Rector\Doctrine\Tests\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Source\TrainingTerm;

/**
 * @\Doctrine\ODM\MongoDB\Mapping\Annotations\Document
 */
class OdmToMany
{
    /**
     * @\Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany(targetDocument="TrainingTerm")
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Fixture\ODM;

use Doctrine\Common\Collections\ArrayCollection;
use Rector\Doctrine\Tests\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Source\TrainingTerm;

/**
 * @\Doctrine\ODM\MongoDB\Mapping\Annotations\Document
 */
class OdmToMany
{
    /**
     * @\Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany(targetDocument="TrainingTerm")
     * @var \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Source\TrainingTerm>
     */
    private \Doctrine\Common\Collections\Collection $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }
}

?>
