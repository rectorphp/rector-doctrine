<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\MethodCall\SetArrayToNewCollectionRector\Source;

use Doctrine\Common\Collections\Collection;

final class SomeClassWithNativeSetter
{
    public function setItems(Collection $items): void
    {
    }
}
