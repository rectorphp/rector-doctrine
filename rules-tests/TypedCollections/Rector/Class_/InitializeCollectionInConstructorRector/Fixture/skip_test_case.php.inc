<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\InitializeCollectionInConstructorRector\Fixture;

use PHPUnit\Framework\TestCase;

final class SkipTestCase extends TestCase
{
    /**
     * @\Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany()
     */
    private $items = [];
}
