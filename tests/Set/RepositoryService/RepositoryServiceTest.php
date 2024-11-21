<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Set\RepositoryService;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Rector\Doctrine\Set\DoctrineSetList;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

final class RepositoryServiceTest extends AbstractRectorTestCase
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
        return DoctrineSetList::REPOSITORY_SERVICE;
    }
}
