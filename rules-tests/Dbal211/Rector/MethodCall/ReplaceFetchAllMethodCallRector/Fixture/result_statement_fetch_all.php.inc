<?php

namespace Rector\Doctrine\Tests\Dbal211\Rector\MethodCall\ReplaceFetchAllMethodCallRector\Fixture;

use Doctrine\DBAL\Driver\ResultStatement;

final class ConnectionFetchArray
{
    public function run(ResultStatement $resultStatement)
    {
        $firstResult = $resultStatement->fetchAll();

        $columns = $resultStatement->fetchAll(\PDO::FETCH_COLUMN);

        $fetchAssoc = $resultStatement->fetchAll(\PDO::FETCH_ASSOC);
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Dbal211\Rector\MethodCall\ReplaceFetchAllMethodCallRector\Fixture;

use Doctrine\DBAL\Driver\ResultStatement;

final class ConnectionFetchArray
{
    public function run(ResultStatement $resultStatement)
    {
        $firstResult = $resultStatement->fetchAll();

        $columns = $resultStatement->fetchFirstColumn();

        $fetchAssoc = $resultStatement->fetchAllAssociative();
    }
}

?>
