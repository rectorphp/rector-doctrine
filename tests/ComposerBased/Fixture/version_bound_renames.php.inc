<?php

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Index;

final class VersionBoundRenames
{
    public function run(Connection $connection, Index $index)
    {
        $schemaManager = $connection->getSchemaManager();
        $isFulfilled = $index->isFullfilledBy([]);

        return [$schemaManager, $isFulfilled];
    }
}

?>
-----
<?php

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Index;

final class VersionBoundRenames
{
    public function run(Connection $connection, Index $index)
    {
        $schemaManager = $connection->createSchemaManager();
        $isFulfilled = $index->isFulfilledBy([]);

        return [$schemaManager, $isFulfilled];
    }
}

?>
