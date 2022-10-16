<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM213Set\Fixture;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;

final class SkipAlreadyUsingCorrectFunction implements EventSubscriber
{
    private ?EntityManagerInterface $entityManager = null;

    /**
     * Returns an array of event names this subscriber wants to listen to.
     */
    public function getSubscribedEvents(): array
    {
        return [Events::onFlush];
    }

    public function onFlush(OnFlushEventArgs $args): void
    {
        $this->entityManager = $args->getObjectManager();
    }
}

?>
