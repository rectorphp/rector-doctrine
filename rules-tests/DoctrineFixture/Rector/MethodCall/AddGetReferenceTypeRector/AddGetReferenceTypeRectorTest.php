<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\DoctrineFixture\Rector\MethodCall\AddGetReferenceTypeRector;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class AddGetReferenceTypeRectorTest extends AbstractRectorTestCase
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
        return __DIR__ . '/config/configured_rule.php';
    }

    /**
     * The rule is bonded to doctrine/data-fixtures, that is not installed here
     */
    protected function provideComposerJsonFilePath(): string
    {
        return __DIR__ . '/config/composer.json';
    }
}
