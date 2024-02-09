<?php

namespace Rector\Doctrine\Tests\Dbal211\Rector\MethodCall\ReplaceFetchAllMethodCallRector\Fixture;

use Doctrine\DBAL\Connection;

final class ConnectionFetchArray
{
    public function run(Connection $connection)
    {
        return $connection->fetchArray('̈́sql', [], []);
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Dbal211\Rector\MethodCall\ReplaceFetchAllMethodCallRector\Fixture;

use Doctrine\DBAL\Connection;

final class ConnectionFetchArray
{
    public function run(Connection $connection)
    {
        return $connection->fetchNumeric('̈́sql', [], []);
    }
}

?>
