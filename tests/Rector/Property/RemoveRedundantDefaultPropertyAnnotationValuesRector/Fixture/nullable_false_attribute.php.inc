<?php

namespace Rector\Doctrine\Tests\Rector\Property\RemoveRedundantDefaultPropertyAnnotationValuesRector\Fixture;

use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\Rector\Property\RemoveRedundantDefaultPropertyAnnotationValuesRector\Source\Training;

#[ORM\Entity]
class NullableFalseAttribute
{
    #[ORM\Column(type:"string", nullable:false)]
    private $training;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Rector\Property\RemoveRedundantDefaultPropertyAnnotationValuesRector\Fixture;

use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\Rector\Property\RemoveRedundantDefaultPropertyAnnotationValuesRector\Source\Training;

#[ORM\Entity]
class NullableFalseAttribute
{
    #[ORM\Column(type:"string")]
    private $training;
}

?>
