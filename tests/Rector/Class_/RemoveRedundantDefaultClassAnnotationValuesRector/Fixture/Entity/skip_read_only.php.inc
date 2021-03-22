<?php

namespace Rector\Doctrine\Tests\Rector\Class_\RemoveRedundantDefaultClassAnnotationValuesRector\Fixture\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(readOnly=true)
 */
class SkipReadOnly
{
}

?>
