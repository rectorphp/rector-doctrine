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

use Doctrine\ORM\Mapping as ORM;

/**
 * News
 */
#[\Doctrine\ORM\Mapping\Table(name: 'news')]
#[\Doctrine\ORM\Mapping\Entity(repositoryClass: 'DoctrineFixtureDemo\Repository\NewsRepository')]
class News
{
    /**
     * @var integer
     */
    #[\Doctrine\ORM\Mapping\Id]
    #[\Doctrine\ORM\Mapping\GeneratedValue(strategy: 'IDENTITY')]
    #[\Doctrine\ORM\Mapping\Column(name: 'id', type: 'bigint', nullable: false)]
    private $id;
    /**
     * @var string
     */
    #[\Doctrine\ORM\Mapping\Column(name: 'title', type: 'string', length: 50, nullable: false)]
    private $title;
    /**
     * @var string
     */
    #[\Doctrine\ORM\Mapping\Column(name: 'content', type: 'string', length: 255, nullable: false)]
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
