<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\CollectionSetterParamNativeTypeRector\Fixture;

use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

final class KeepNullableInTests extends TestCase
{
    /**
     * @param Collection<int, string>|null $items
     */
    public function tests($items = null): void
    {
    }
}
