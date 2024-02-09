<?php

namespace Rector\Doctrine\Tests\Dbal211\Rector\MethodCall\ReplaceFetchAllMethodCallRector\Fixture;

use Doctrine\DBAL\Driver\ResultStatement;

final class FetchColumn
{
    public function run(ResultStatement $resultStatement)
    {
        $column = $resultStatement->fetchColumn();
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Dbal211\Rector\MethodCall\ReplaceFetchAllMethodCallRector\Fixture;

use Doctrine\DBAL\Driver\ResultStatement;

final class FetchColumn
{
    public function run(ResultStatement $resultStatement)
    {
        $column = $resultStatement->fetchOne();
    }
}

?>
