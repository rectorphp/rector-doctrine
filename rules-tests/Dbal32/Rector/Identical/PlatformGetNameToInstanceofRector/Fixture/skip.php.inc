<?php

namespace Rector\Doctrine\Tests\Dbal32\Rector\Identical\PlatformGetNameToInstanceofRector;

class SkipTest
{
    public function run($someObject): void
    {
        // Skip: Not a method call (comparing string to standard variable)
        if ('postgresql' === $someObject) {
            return;
        }

        // Skip: Method name is not getName()
        if ('postgresql' === $someObject->getDatabaseType()) {
            return;
        }

        // Skip: Unknown/custom platform string not in PLATFORM_MAP
        if ($someObject->getName() === 'postgresql') {
            return;
        }
        if ('postgresql' === $someObject->getName()) {
            return;
        }

        // Skip: Comparing getName() result to an integer or non-string
        if (123 === $someObject->getName()) {
            return;
        }
    }
}
