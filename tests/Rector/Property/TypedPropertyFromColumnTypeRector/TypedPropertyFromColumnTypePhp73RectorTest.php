<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Rector\Property\TypedPropertyFromColumnTypeRector;

use Iterator;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Symplify\SmartFileSystem\SmartFileInfo;

final class TypedPropertyFromColumnTypePhp73RectorTest extends AbstractRectorTestCase
{
    /**
     * @dataProvider provideData()
     */
    public function test(SmartFileInfo $fileInfo): void
    {
        $this->doTestFileInfo($fileInfo);
    }

    /**
     * @return Iterator<SmartFileInfo>
     */
    public function provideData(): Iterator
    {
        return $this->yieldFilesFromDirectory(__DIR__ . '/FixturePhp73');
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/non_typed_properties.php';
    }
}
