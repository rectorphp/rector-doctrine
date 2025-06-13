<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\FuncCall\CurrentOnCollectionToArrayRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SimpleClass
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function merge()
    {
        return current($this->items);
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\FuncCall\CurrentOnCollectionToArrayRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SimpleClass
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function merge()
    {
        return current($this->items->toArray());
    }
}

?>
