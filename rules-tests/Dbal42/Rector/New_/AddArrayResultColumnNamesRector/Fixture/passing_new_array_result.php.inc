<?php

namespace Rector\Doctrine\Tests\Dbal42\Rector\New_\AddArrayResultColumnNamesRector\Fixture;

use Doctrine\DBAL\Cache\ArrayResult;

final class SomeClass
{
    public function run(array $items)
    {
        $result = new ArrayResult($items);
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Dbal42\Rector\New_\AddArrayResultColumnNamesRector\Fixture;

use Doctrine\DBAL\Cache\ArrayResult;

final class SomeClass
{
    public function run(array $items)
    {
        $result = new ArrayResult(array_keys($items[0] ?? []), $items);
    }
}

?>
