<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Namespace_\NamespaceAliasRector\Fixture;

use Doctrine\ODM\MongoDB\Mapping\Attribute\Document;
use Doctrine\ODM\MongoDB\Mapping\Attribute\Id;
use Doctrine\ODM\MongoDB\Mapping\Attribute\Version;
use Some\OtherImport;

#[Document]
final class Post
{
    #[Id]
    private string $id;

    #[Version]
    private int $version;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Namespace_\NamespaceAliasRector\Fixture;

use Doctrine\ODM\MongoDB\Mapping\Attribute as ODM;
use Some\OtherImport;

#[ODM\Document]
final class Post
{
    #[ODM\Id]
    private string $id;

    #[ODM\Version]
    private int $version;
}

?>
