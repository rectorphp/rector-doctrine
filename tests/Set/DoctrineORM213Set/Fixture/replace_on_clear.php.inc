<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM213Set\Fixture;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnClearEventArgs;
use Doctrine\ORM\Events;

final class ReplaceOnClear implements EventSubscriber
{
    /**
     * Returns an array of event names this subscriber wants to listen to.
     */
    public function getSubscribedEvents(): array
    {
        return [Events::onClear];
    }

    public function onClear(OnClearEventArgs $args): void
    {
        $entityManager = $args->getEntityManager();
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM213Set\Fixture;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnClearEventArgs;
use Doctrine\ORM\Events;

final class ReplaceOnClear implements EventSubscriber
{
    /**
     * Returns an array of event names this subscriber wants to listen to.
     */
    public function getSubscribedEvents(): array
    {
        return [Events::onClear];
    }

    public function onClear(OnClearEventArgs $args): void
    {
        $entityManager = $args->getObjectManager();
    }
}

?>
