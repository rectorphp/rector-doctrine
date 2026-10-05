<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeAnalyzer;

use Rector\Php\PhpVersionProvider;
use Rector\Php\PolyfillPackagesProvider;
use Rector\ValueObject\PhpVersion;

final readonly class SortDirectionAvailabilityResolver
{
    public function __construct(
        private PhpVersionProvider $phpVersionProvider,
        private PolyfillPackagesProvider $polyfillPackagesProvider,
    ) {
    }

    /**
     * SortDirection is native since PHP 8.6, back-filled on PHP 8.1+ via symfony/polyfill-php86.
     */
    public function isAvailable(): bool
    {
        if ($this->phpVersionProvider->provide() >= PhpVersion::PHP_86) {
            return true;
        }

        return in_array('symfony/polyfill-php86', $this->polyfillPackagesProvider->provide(), true);
    }
}
