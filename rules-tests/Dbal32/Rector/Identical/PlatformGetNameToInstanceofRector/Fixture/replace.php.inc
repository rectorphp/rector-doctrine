<?php

namespace Rector\Doctrine\Tests\Dbal32\Rector\Identical\PlatformGetNameToInstanceofRector;

use Doctrine\DBAL\Platforms\AbstractPlatform;

class TestMigration
{
    /** @var AbstractPlatform */
    public $platform;

    public function run(): void
    {
        if ('postgresql' === $this->platform->getName()) {
            echo "Is Postgres";
        }

        if ($this->platform->getName() === 'postgresql') {
            echo "Is Postgres";
        }

        if ($this->platform->getName() === 'mysql') {
            echo "Is MySQL";
        }

        if ($this->platform->getName() === 'sqlite') {
            echo "Is SQLite";
        }

        if ($this->platform->getName() === 'oracle') {
            echo "Is Oracle";
        }

        if ($this->platform->getName() === 'mssql') {
            echo "Is SQL Server";
        }

        if ($this->platform->getName() === 'db2') {
            echo "Is DB2";
        }

        if ($this->platform->getName() === 'unknown_db') {
            echo "Is Unknown";
        }
    }
}

-----
<?php

namespace Rector\Doctrine\Tests\Dbal32\Rector\Identical\PlatformGetNameToInstanceofRector;

use Doctrine\DBAL\Platforms\AbstractPlatform;

class TestMigration
{
    /** @var AbstractPlatform */
    public $platform;

    public function run(): void
    {
        if ($this->platform instanceof \Doctrine\DBAL\Platforms\PostgreSQLPlatform) {
            echo "Is Postgres";
        }

        if ($this->platform instanceof \Doctrine\DBAL\Platforms\PostgreSQLPlatform) {
            echo "Is Postgres";
        }

        if ($this->platform instanceof \Doctrine\DBAL\Platforms\MySQLPlatform) {
            echo "Is MySQL";
        }

        if ($this->platform instanceof \Doctrine\DBAL\Platforms\SqlitePlatform) {
            echo "Is SQLite";
        }

        if ($this->platform instanceof \Doctrine\DBAL\Platforms\OraclePlatform) {
            echo "Is Oracle";
        }

        if ($this->platform instanceof \Doctrine\DBAL\Platforms\SQLServerPlatform) {
            echo "Is SQL Server";
        }

        if ($this->platform instanceof \Doctrine\DBAL\Platforms\DB2Platform) {
            echo "Is DB2";
        }

        if ($this->platform->getName() === 'unknown_db') {
            echo "Is Unknown";
        }
    }
}
