<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\FuncCall\ArrayMergeOnCollectionToArrayRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SetFirstParameterArray
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function merge()
    {
        return array_merge([], $this->items);
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\FuncCall\ArrayMergeOnCollectionToArrayRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SetFirstParameterArray
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function merge()
    {
        return array_merge([], $this->items->toArray());
    }
}

?>
