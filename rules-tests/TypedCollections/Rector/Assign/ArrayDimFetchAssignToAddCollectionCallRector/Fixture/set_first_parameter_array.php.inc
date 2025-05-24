<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Assign\ArrayDimFetchAssignToAddCollectionCallRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SetFirstParameterArray
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function setItems($item)
    {
        $this->items[] = $item;
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Assign\ArrayDimFetchAssignToAddCollectionCallRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class SetFirstParameterArray
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function setItems($item)
    {
        $this->items->add($item);
    }
}

?>
