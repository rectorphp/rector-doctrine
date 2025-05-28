<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class SoleParamArrayCollectionType
{
    public function someMethod(ArrayCollection $arrayCollection)
    {
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\NarrowArrayCollectionToCollectionRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;

final class SoleParamArrayCollectionType
{
    public function someMethod(\Doctrine\Common\Collections\Collection $arrayCollection)
    {
    }
}

?>
