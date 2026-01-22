<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Namespace_\NamespaceAliasRector\Fixture;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Some\OtherImport;

#[Entity]
final class Article
{
    #[Id]
    #[Column(type: 'integer')]
    public int $id;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Namespace_\NamespaceAliasRector\Fixture;

use Doctrine\ORM\Mapping as ORM;
use Some\OtherImport;

#[ORM\Entity]
final class Article
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    public int $id;
}

?>
