<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Set\DoctrineODM23Set\Fixture;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * News
 *
 * @MongoDB\Document(collection="news", repositoryClass="DoctrineFixtureDemo\Repository\NewsRepository")
 */
class News
{
    /**
     * @var string
     *
     * @MongoDB\Id
     */
    private $id;
    /**
     * @var string
     *
     * @MongoDB\Field(name="title", type="string", nullable=false)
     */
    private $title;
    /**
     * @var string
     *
     * @MongoDB\Field(name="content", type="string", nullable=false)
     */
    private $content;
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Set\DoctrineODM23Set\Fixture;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * News
 */
#[MongoDB\Document(collection: 'news', repositoryClass: 'DoctrineFixtureDemo\Repository\NewsRepository')]
class News
{
    /**
     * @var string
     */
    #[MongoDB\Id]
    private $id;
    /**
     * @var string
     */
    #[MongoDB\Field(name: 'title', type: 'string', nullable: false)]
    private $title;
    /**
     * @var string
     */
    #[MongoDB\Field(name: 'content', type: 'string', nullable: false)]
    private $content;
}

?>
