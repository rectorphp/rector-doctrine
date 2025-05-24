<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\DefaultNewArrayCollectionRector\Fixture;

use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

final class SkipTestCase extends TestCase
{
    /**
     * @var Collection<int, string>
     */
    public $items;
}
