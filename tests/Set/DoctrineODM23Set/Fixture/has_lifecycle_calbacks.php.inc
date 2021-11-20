<?php

namespace Rector\Doctrine\Tests\Set\DoctrineODM23Set\Fixture;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 * @MongoDB\HasLifecycleCallbacks
 */
class User
{
    /**
     * @MongoDB\PostLoad
     */
    public function methodPostLoad()
    {
    }
    /**
     * @MongoDB\PrePersist
     */
    public function methodPrePersist()
    {
    }
    /**
     * @MongoDB\PostPersist
     */
    public function methodPostPersist()
    {
    }
    /**
     * @MongoDB\PreRemove
     */
    public function methodPreRemove()
    {
    }
    /**
     * @MongoDB\PostRemove
     */
    public function methodPostRemove()
    {
    }
    /**
     * @MongoDB\PreUpdate
     */
    public function methodPreUpdate()
    {
    }
    /**
     * @MongoDB\PostUpdate
     */
    public function methodPostUpdate()
    {
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\DoctrineODM23Set\Fixture;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

#[MongoDB\Document]
#[MongoDB\HasLifecycleCallbacks]
class User
{
    #[MongoDB\PostLoad]
    public function methodPostLoad()
    {
    }
    #[MongoDB\PrePersist]
    public function methodPrePersist()
    {
    }
    #[MongoDB\PostPersist]
    public function methodPostPersist()
    {
    }
    #[MongoDB\PreRemove]
    public function methodPreRemove()
    {
    }
    #[MongoDB\PostRemove]
    public function methodPostRemove()
    {
    }
    #[MongoDB\PreUpdate]
    public function methodPreUpdate()
    {
    }
    #[MongoDB\PostUpdate]
    public function methodPostUpdate()
    {
    }
}

?>
