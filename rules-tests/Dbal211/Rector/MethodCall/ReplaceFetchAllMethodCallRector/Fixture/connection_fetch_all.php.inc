<?php

namespace Rector\Doctrine\Tests\Dbal211\Rector\MethodCall\ReplaceFetchAllMethodCallRector\Fixture;

use Doctrine\DBAL\Connection;

class ConnectionFetchAll
{
    public function run(Connection $connection)
    {
        return $connection->fetchAll();
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Dbal211\Rector\MethodCall\ReplaceFetchAllMethodCallRector\Fixture;

use Doctrine\DBAL\Connection;

class ConnectionFetchAll
{
    public function run(Connection $connection)
    {
        return $connection->fetchAllAssociative();
    }
}

?>
