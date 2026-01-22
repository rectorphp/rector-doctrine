<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Namespace_\NamespaceAliasRector\Fixture;

use Doctrine\ODM\MongoDB\Mapping\Attribute\{Document, EmbedOne as Embedded};
use Doctrine\ODM\MongoDB\Mapping\Attribute\EmbedMany as Many;
use Some\OtherImport;

#[Document]
final class Blog
{
    #[Embedded]
    public Post $post;

    #[Many]
    public array $comments;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Namespace_\NamespaceAliasRector\Fixture;

use Doctrine\ODM\MongoDB\Mapping\Attribute as ODM;
use Some\OtherImport;

#[ODM\Document]
final class Blog
{
    #[ODM\EmbedOne]
    public Post $post;

    #[ODM\EmbedMany]
    public array $comments;
}

?>
