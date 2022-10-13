<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM213Set\Fixture;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Events;

final class ReplacePreFlush implements EventSubscriber
{
    /**
     * Returns an array of event names this subscriber wants to listen to.
     */
    public function getSubscribedEvents(): array
    {
        return [Events::preFlush];
    }

    public function onFlush(PreFlushEventArgs $args): void
    {
        $entityManager = $args->getEntityManager();
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM213Set\Fixture;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Doctrine\ORM\Events;

final class ReplacePreFlush implements EventSubscriber
{
    /**
     * Returns an array of event names this subscriber wants to listen to.
     */
    public function getSubscribedEvents(): array
    {
        return [Events::preFlush];
    }

    public function onFlush(PreFlushEventArgs $args): void
    {
        $entityManager = $args->getObjectManager();
    }
}

?>
