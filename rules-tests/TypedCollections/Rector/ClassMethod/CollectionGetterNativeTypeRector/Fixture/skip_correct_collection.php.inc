<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\CollectionGetterNativeTypeRector\Fixture;

use Doctrine\Common\Collections\Collection;

final class ReturnPropertyCollectionWithArrayTypeDeclaration
{
    /**
     * @var Collection<int, string>
     */
    public $items;

    public function getItems(): Collection
    {
        return $this->items;
    }
}
