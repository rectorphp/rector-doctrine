<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Namespace_\NamespaceAliasRector\Fixture;

use Doctrine\ODM\MongoDB\Mapping\Attribute as ODM;

#[ODM\Document]
final class BlogPost
{
    #[ODM\Id]
    private string $id;

    #[ODM\Field]
    private string $title;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Namespace_\NamespaceAliasRector\Fixture;

use Doctrine\ODM\MongoDB\Mapping\Attribute as ODM;

#[ODM\Document]
final class BlogPost
{
    #[ODM\Id]
    private string $id;

    #[ODM\Field]
    private string $title;
}

?>
