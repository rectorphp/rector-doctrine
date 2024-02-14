<?php

namespace Rector\Doctrine\Tests\Bundle210\Rector\Class_\EventSubscriberInterfaceToAttributeRector\Fixture;

use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PostUpdateEventArgs;
use Doctrine\ORM\Events;

class MyEventSubscriber implements \Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface
{
    public function getSubscribedEvents()
    {
        return array(
            Events::postUpdate,
            Events::prePersist,
            'postPersist',
            Events::postFlush,
        );
    }

    public function postUpdate(PostUpdateEventArgs $args)
    {
        // ...
    }

    public function prePersist(PrePersistEventArgs $args)
    {
        // ...
    }

    public function postPersist(PostPersistEventArgs $args)
    {
        // ...
    }

    public function postFlush(PostFlushEventArgs $args): void
    {
        // ...
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Bundle210\Rector\Class_\EventSubscriberInterfaceToAttributeRector\Fixture;

use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PostUpdateEventArgs;
use Doctrine\ORM\Events;

#[\Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener(event: Events::postUpdate)]
#[\Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener(event: Events::prePersist)]
#[\Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener(event: 'postPersist')]
#[\Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener(event: Events::postFlush)]
class MyEventSubscriber
{
    public function postUpdate(PostUpdateEventArgs $args)
    {
        // ...
    }
    public function prePersist(PrePersistEventArgs $args)
    {
        // ...
    }
    public function postPersist(PostPersistEventArgs $args)
    {
        // ...
    }
    public function postFlush(PostFlushEventArgs $args): void
    {
        // ...
    }
}

?>
