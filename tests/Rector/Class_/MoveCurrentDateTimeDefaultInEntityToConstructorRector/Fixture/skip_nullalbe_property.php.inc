<?php

namespace Rector\Doctrine\Tests\Rector\Class_\MoveCurrentDateTimeDefaultInEntityToConstructorRector\Fixture;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

final class SkipNullalbeProperty
{
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected ?DateTime $date = null;

    public function __construct()
    {
    }
}
