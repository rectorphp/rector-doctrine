<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Rector\Class_\TranslationBehaviorRector;

use Iterator;
use Rector\FileSystemRector\ValueObject\AddedFileWithContent;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Symplify\SmartFileSystem\SmartFileInfo;
use Symplify\SmartFileSystem\SmartFileSystem;

final class TranslationBehaviorRectorTest extends AbstractRectorTestCase
{
    /**
     * @dataProvider provideData()
     */
    public function test(SmartFileInfo $fixtureFileInfo, AddedFileWithContent $expectedAddedFileWithContent): void
    {
        $this->doTestFileInfo($fixtureFileInfo);
        $this->assertFileWasAdded($expectedAddedFileWithContent);
    }

    /**
     * @return Iterator<array<SmartFileInfo|AddedFileWithContent>>
     */
    public function provideData(): Iterator
    {
        $smartFileSystem = new SmartFileSystem();

        yield [
            new SmartFileInfo(__DIR__ . '/Fixture/fixture.php.inc'),
            new AddedFileWithContent(
                $this->getFixtureTempDirectory() . '/SomeClassTranslation.php',
                $smartFileSystem->readFile(__DIR__ . '/Source/SomeClassTranslation.php')
            ),
        ];
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/configured_rule.php';
    }
}
