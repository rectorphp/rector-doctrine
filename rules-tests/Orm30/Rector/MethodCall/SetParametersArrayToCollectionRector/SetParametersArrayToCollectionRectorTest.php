<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Orm30\Rector\MethodCall\SetParametersArrayToCollectionRector;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class SetParametersArrayToCollectionRectorTest extends AbstractRectorTestCase
{
    #[DataProvider('provideData')]
    public function test(string $filePath): void
    {
        $this->doTestFile($filePath);
    }

    public static function provideData(): Iterator
    {
        return self::yieldFilesFromDirectory(__DIR__ . '/Fixtures');
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/configured_rule.php';
    }
}
