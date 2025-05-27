<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIsArrayOnCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class RemoveTernaryElse
{
    public Collection $items;

    public function someMethod()
    {
        $values = is_array($this->items) ? [] : ['two'];
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIsArrayOnCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class RemoveTernaryElse
{
    public Collection $items;

    public function someMethod()
    {
        $values = ['two'];
    }
}

?>
