<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\DefaultNewArrayCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class ClassSomeEntity
{
    /**
     * @var Collection<int, string>
     */
    public $items;
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\DefaultNewArrayCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class ClassSomeEntity
{
    /**
     * @var Collection<int, string>
     */
    public $items;
    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }
}

?>
