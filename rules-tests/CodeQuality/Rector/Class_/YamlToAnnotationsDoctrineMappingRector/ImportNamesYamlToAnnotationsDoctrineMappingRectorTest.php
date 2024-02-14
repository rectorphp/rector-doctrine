<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class ImportNamesYamlToAnnotationsDoctrineMappingRectorTest extends AbstractRectorTestCase
{
    #[DataProvider('provideData')]
    public function test(string $filePath): void
    {
        $this->doTestFile($filePath);
    }

    public static function provideData(): Iterator
    {
        return self::yieldFilesFromDirectory(__DIR__ . '/ImportNamesFixture');
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/import_names.php';
    }
}
