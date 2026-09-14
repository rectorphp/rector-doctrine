<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Orm32\Rector\MethodCall\DoctrineQueryBuilderSortDirectionRector;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class DoctrineQueryBuilderSortDirectionRectorTest extends AbstractRectorTestCase
{
    #[DataProvider('provideData')]
    public function test(string $filePath): void
    {
        $this->doTestFile($filePath);
    }

    public static function provideData(): Iterator
    {
        return self::yieldFilesFromDirectory(__DIR__ . '/Fixture');
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/configured_rule.php';
    }
}
