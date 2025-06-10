<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\CollectionParamTypeSetterToCollectionPropertyRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class SkipConstructorSetter
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function __construct($item)
    {
        $this->items = new ArrayCollection([]);
    }
}
