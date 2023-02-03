<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set;

use Iterator;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class Php81NestedAttributesTest extends AbstractRectorTestCase
{
    /**
     * @dataProvider provideData()
     */
    public function test(string $filePath): void
    {
        $this->doTestFile($filePath);
    }

        public function provideData(): Iterator
        {
            return self::yieldFilesFromDirectory(__DIR__ . '/FixturePhp81');
        }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/php81_nested_attributes.php';
    }
}
