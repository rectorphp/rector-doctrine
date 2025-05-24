<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\NarrowPropertyUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class ExtraNullOnClearPropertyType
{
    /**
     * @var ArrayCollection<int>|null
     */
    public Collection $items;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\NarrowPropertyUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class ExtraNullOnClearPropertyType
{
    /**
     * @var \Doctrine\Common\Collections\Collection<int>
     */
    public Collection $items;
}

?>
