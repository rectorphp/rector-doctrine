<?php

declare(strict_types=1);

namespace Doctrine\Common\DataFixtures;

abstract class AbstractFixture
{
    public function getReference($id, ?string $class = null)
    {
    }
}
