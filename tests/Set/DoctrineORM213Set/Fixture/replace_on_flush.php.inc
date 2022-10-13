<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM213Set\Fixture;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;

final class ReplaceOnFlush implements EventSubscriber
{
    /**
     * Returns an array of event names this subscriber wants to listen to.
     */
    public function getSubscribedEvents(): array
    {
        return [Events::onFlush];
    }

    public function onFlush(OnFlushEventArgs $args): void
    {
        $entityManager = $args->getEntityManager();
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM213Set\Fixture;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;

final class ReplaceOnFlush implements EventSubscriber
{
    /**
     * Returns an array of event names this subscriber wants to listen to.
     */
    public function getSubscribedEvents(): array
    {
        return [Events::onFlush];
    }

    public function onFlush(OnFlushEventArgs $args): void
    {
        $entityManager = $args->getObjectManager();
    }
}

?>
