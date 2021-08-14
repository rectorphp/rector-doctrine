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

#[\Doctrine\ODM\MongoDB\Mapping\Annotations\Document]
#[\Doctrine\ODM\MongoDB\Mapping\Annotations\HasLifecycleCallbacks]
class User
{
    #[\Doctrine\ODM\MongoDB\Mapping\Annotations\PostLoad]
    public function methodPostLoad()
    {
    }
    #[\Doctrine\ODM\MongoDB\Mapping\Annotations\PrePersist]
    public function methodPrePersist()
    {
    }
    #[\Doctrine\ODM\MongoDB\Mapping\Annotations\PostPersist]
    public function methodPostPersist()
    {
    }
    #[\Doctrine\ODM\MongoDB\Mapping\Annotations\PreRemove]
    public function methodPreRemove()
    {
    }
    #[\Doctrine\ODM\MongoDB\Mapping\Annotations\PostRemove]
    public function methodPostRemove()
    {
    }
    #[\Doctrine\ODM\MongoDB\Mapping\Annotations\PreUpdate]
    public function methodPreUpdate()
    {
    }
    #[\Doctrine\ODM\MongoDB\Mapping\Annotations\PostUpdate]
    public function methodPostUpdate()
    {
    }
}

?>
