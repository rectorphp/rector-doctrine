<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\CorrectDefaultTypesOnEntityPropertyRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

final class SkipNegativeInt
{
    /**
     * @ORM\Column(name="thing", type="integer")
     */
    protected $thing = -1;
}
