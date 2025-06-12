<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\NarrowPropertyUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class UnionNativeType
{
    private Collection|array|null $keyValues = null;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\NarrowPropertyUnionToCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class UnionNativeType
{
    private \Doctrine\Common\Collections\Collection $keyValues;
}

?>
