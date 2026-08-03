<?php

namespace Rector\Doctrine\Tests\ComposerBased\Fixture;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
final class VersionBoundAnnotationToAttribute
{
    /**
     * @ORM\Column(type="string")
     */
    private $name;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\ComposerBased\Fixture;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
final class VersionBoundAnnotationToAttribute
{
    #[ORM\Column(type: 'string')]
    private $name;
}

?>
