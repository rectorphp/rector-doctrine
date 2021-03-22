<?php

namespace Rector\Doctrine\Tests\Rector\Class_\MoveCurrentDateTimeDefaultInEntityToConstructorRector\Fixture;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class SkipNullDefaults
{
    /**
     * @var DateTimeInterface
     *
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $when;
}
