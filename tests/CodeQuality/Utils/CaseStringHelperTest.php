<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\CodeQuality\Utils;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Rector\Doctrine\CodeQuality\Utils\CaseStringHelper;

final class CaseStringHelperTest extends TestCase
{
    #[DataProvider('provideData')]
    public function testCamelCase(string $value, string $expectedValue): void
    {
        $this->assertSame($expectedValue, CaseStringHelper::camelCase($value));
    }

    /**
     * @return Iterator<array{string, string}>
     */
    public static function provideData(): Iterator
    {
        yield ['some_property', 'someProperty'];
        yield ['someProperty', 'someProperty'];
        yield ['some property', 'someProperty'];
        yield ['some-property', 'someproperty'];
    }
}
