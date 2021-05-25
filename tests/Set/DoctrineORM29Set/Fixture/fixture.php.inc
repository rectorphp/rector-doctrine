<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="news")
 * @ORM\Entity(repositoryClass="DoctrineFixtureDemo\Repository\NewsRepository")
 */
class News
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=50, nullable=false)
     */
    private $title;
    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255, nullable=false)
     */
    private $content;
    /**
     * Get id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set title.
     *
     * @param string $title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * Set content.
     *
     * @param string $content
     *
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }
    /**
     * Get content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping as ORM;

/**
 * News
 */
#[Table(name: 'news')]
#[Entity(repositoryClass: 'DoctrineFixtureDemo\Repository\NewsRepository')]
class News
{
    /**
     * @var integer
     */
    #[Id]
    #[GeneratedValue(strategy: 'IDENTITY')]
    #[Column(name: 'id', type: 'bigint', nullable: false)]
    private $id;
    /**
     * @var string
     */
    #[Column(name: 'title', type: 'string', length: 50, nullable: false)]
    private $title;
    /**
     * @var string
     */
    #[Column(name: 'content', type: 'string', length: 255, nullable: false)]
    private $content;
    /**
     * Get id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set title.
     *
     * @param string $title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * Set content.
     *
     * @param string $content
     *
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }
    /**
     * Get content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}

?>
