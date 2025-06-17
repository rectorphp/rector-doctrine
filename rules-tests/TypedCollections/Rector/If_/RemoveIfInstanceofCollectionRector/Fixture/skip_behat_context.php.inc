<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector\Fixture;

use Behat\Behat\Context\Context;

final class SkipBehatContext implements Context
{
    public function letItBe(?\Doctrine\Common\Collections\Collection $collection)
    {
        if (! $collection instanceof \Doctrine\Common\Collections\Collection) {
            throw new \InvalidArgumentException();
        }
    }
}
