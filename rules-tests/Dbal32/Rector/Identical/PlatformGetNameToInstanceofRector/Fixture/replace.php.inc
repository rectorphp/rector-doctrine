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

        if ($this->platform->getName() === 'unknown_db') {
            echo "Is Unknown";
        }
    }
}
