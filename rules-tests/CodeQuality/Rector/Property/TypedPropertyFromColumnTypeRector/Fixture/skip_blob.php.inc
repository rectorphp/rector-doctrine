<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromColumnTypeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

class SkipBlob
{
    /**
     * @ORM\Column(type="blob")
     *
     * @var resource
     */
    private $content = null;
}
