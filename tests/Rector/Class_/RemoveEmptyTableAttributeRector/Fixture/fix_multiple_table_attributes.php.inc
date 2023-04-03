<?php

namespace Rector\Doctrine\Tests\Rector\AttributeGroup\RemoveEmptyTableAttributeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table]
#[ORM\Table]
#[ORM\Entity]
class Product
{
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Rector\AttributeGroup\RemoveEmptyTableAttributeRector\Fixture;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Product
{
}

?>
