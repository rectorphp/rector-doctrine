<?php

namespace Rector\Doctrine\Tests\Dbal42\Rector\New_\AddArrayResultColumnNamesRector\Fixture;

use Doctrine\DBAL\Cache\ArrayResult;

final class SkipAlreadyTwoArgs
{
    public function run(array $items)
    {
        $result = new ArrayResult(['name'], $items);
    }
}
