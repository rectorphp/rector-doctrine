<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\PostLoad;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PostPersist;
use Doctrine\ORM\Mapping\PreRemove;
use Doctrine\ORM\Mapping\PostRemove;
use Doctrine\ORM\Mapping\PreUpdate;
use Doctrine\ORM\Mapping\PostUpdate;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

/**
 * @Entity
 * @HasLifecycleCallbacks
 */
class User
{
    /**
     * @PostLoad
     */
    public function methodPostLoad()
    {
    }
    /**
     * @PrePersist
     */
    public function methodPrePersist()
    {
    }
    /**
     * @PostPersist
     */
    public function methodPostPersist()
    {
    }
    /**
     * @PreRemove
     */
    public function methodPreRemove()
    {
    }
    /**
     * @PostRemove
     */
    public function methodPostRemove()
    {
    }
    /**
     * @PreUpdate
     */
    public function methodPreUpdate()
    {
    }
    /**
     * @PostUpdate
     */
    public function methodPostUpdate()
    {
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM29Set\Fixture;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\PostLoad;
use Doctrine\ORM\Mapping\PrePersist;
use Doctrine\ORM\Mapping\PostPersist;
use Doctrine\ORM\Mapping\PreRemove;
use Doctrine\ORM\Mapping\PostRemove;
use Doctrine\ORM\Mapping\PreUpdate;
use Doctrine\ORM\Mapping\PostUpdate;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;

#[\Doctrine\ORM\Mapping\Entity]
#[\Doctrine\ORM\Mapping\HasLifecycleCallbacks]
class User
{
    #[\Doctrine\ORM\Mapping\PostLoad]
    public function methodPostLoad()
    {
    }
    #[\Doctrine\ORM\Mapping\PrePersist]
    public function methodPrePersist()
    {
    }
    #[\Doctrine\ORM\Mapping\PostPersist]
    public function methodPostPersist()
    {
    }
    #[\Doctrine\ORM\Mapping\PreRemove]
    public function methodPreRemove()
    {
    }
    #[\Doctrine\ORM\Mapping\PostRemove]
    public function methodPostRemove()
    {
    }
    #[\Doctrine\ORM\Mapping\PreUpdate]
    public function methodPreUpdate()
    {
    }
    #[\Doctrine\ORM\Mapping\PostUpdate]
    public function methodPostUpdate()
    {
    }
}

?>
