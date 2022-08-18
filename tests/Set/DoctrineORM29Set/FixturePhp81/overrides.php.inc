<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\FixturePhp81;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\AssociationOverrides({
 *     @ORM\AssociationOverride(name="propertyA", inversedBy="propertyB")
 * })
 * @ORM\AttributeOverrides({
 *     @ORM\AttributeOverride(name="id", column=@ORM\Column(type="integer"))
 * })
 */
class Overrides
{
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\FixturePhp81;

use Doctrine\ORM\Mapping as ORM;

#[ORM\AssociationOverrides([new ORM\AssociationOverride(name: 'propertyA', inversedBy: 'propertyB')])]
#[ORM\AttributeOverrides([new ORM\AttributeOverride(name: 'id', column: new ORM\Column(type: 'integer'))])]
class Overrides
{
}

?>
