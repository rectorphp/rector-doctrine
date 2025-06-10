<?php

namespace Rector\Doctrine\Tests\Set\TypedCollections\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager;

final class ParamTypePosition
{
    private array $items;

    /**
     * @param mixed[]|ArrayCollection $collection
     */
    public function __construct(
        private readonly DocumentManager $documentManager,
        private $collection
    ) {
        foreach ($this->collection as $item) {
            $this->items[] = $item;
        }
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\TypedCollections\Fixture;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\DocumentManager;

final class ParamTypePosition
{
    private array $items;

    /**
     * @param Collection<int, mixed> $collection
     */
    public function __construct(
        private readonly DocumentManager $documentManager,
        private Collection $collection
    ) {
        foreach ($this->collection as $item) {
            $this->items[] = $item;
        }
    }
}

?>
