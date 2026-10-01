<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\NodeAnalyzer\SortDirectionAvailabilityResolver;

use Override;
use Rector\Configuration\Option;
use Rector\Configuration\Parameter\SimpleParameterProvider;
use Rector\Doctrine\NodeAnalyzer\SortDirectionAvailabilityResolver;
use Rector\Testing\PHPUnit\AbstractLazyTestCase;
use Rector\ValueObject\PhpVersion;

final class SortDirectionAvailabilityResolverTest extends AbstractLazyTestCase
{
    private SortDirectionAvailabilityResolver $sortDirectionAvailabilityResolver;

    #[Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->sortDirectionAvailabilityResolver = $this->make(SortDirectionAvailabilityResolver::class);
    }

    #[Override]
    protected function tearDown(): void
    {
        // restore the PHPUnit defaults, as parameters are static and would leak into other tests
        SimpleParameterProvider::setParameter(Option::PHP_VERSION_FEATURES, PhpVersion::PHP_10);
        SimpleParameterProvider::setParameter(Option::POLYFILL_PACKAGES, []);

        parent::tearDown();
    }

    public function testAvailableOnPhp86(): void
    {
        SimpleParameterProvider::setParameter(Option::PHP_VERSION_FEATURES, PhpVersion::PHP_86);
        SimpleParameterProvider::setParameter(Option::POLYFILL_PACKAGES, []);

        $this->assertTrue($this->sortDirectionAvailabilityResolver->isAvailable());
    }

    public function testAvailableOnPhp81WithPolyfill(): void
    {
        SimpleParameterProvider::setParameter(Option::PHP_VERSION_FEATURES, PhpVersion::PHP_81);
        SimpleParameterProvider::setParameter(Option::POLYFILL_PACKAGES, ['symfony/polyfill-php86']);

        $this->assertTrue($this->sortDirectionAvailabilityResolver->isAvailable());
    }

    public function testNotAvailableOnPhp81WithoutPolyfill(): void
    {
        SimpleParameterProvider::setParameter(Option::PHP_VERSION_FEATURES, PhpVersion::PHP_81);
        SimpleParameterProvider::setParameter(Option::POLYFILL_PACKAGES, []);

        $this->assertFalse($this->sortDirectionAvailabilityResolver->isAvailable());
    }
}
