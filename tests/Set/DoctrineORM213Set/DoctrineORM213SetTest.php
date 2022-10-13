<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Set\DoctrineORM213Set;

use Iterator;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class DoctrineORM213SetTest extends AbstractRectorTestCase
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
        return $this->yieldFilesFromDirectory(__DIR__ . '/Fixture');
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/configured_set.php';
    }
}
