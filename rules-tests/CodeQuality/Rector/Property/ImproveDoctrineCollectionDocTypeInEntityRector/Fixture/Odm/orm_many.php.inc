<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Fixture\Odm;

use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training;

/**
 * @\Doctrine\ODM\MongoDB\Mapping\Annotations\Document
 */
final class OdmMany
{
    /**
     * @\Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany(targetDocument="Training")
     */
    private $items = [];

    public function getItems()
    {
        return $this->items;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Fixture\Odm;

use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training;

/**
 * @\Doctrine\ODM\MongoDB\Mapping\Annotations\Document
 */
final class OdmMany
{
    /**
     * @\Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany(targetDocument="Training")
     * @var \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training>
     */
    private $items = [];

    public function getItems()
    {
        return $this->items;
    }
}

?>
