<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Source\TrainingTerm;

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
