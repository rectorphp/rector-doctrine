<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Rector\Property\TypedPropertyFromColumnTypeRector;

use Iterator;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class TypedPropertyFromColumnTypePhp73RectorTest extends AbstractRectorTestCase
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
            return $this->yieldFilePathsFromDirectory(__DIR__ . '/FixturePhp73');
        }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/non_typed_properties.php';
    }
}
