<?php

namespace Rector\Doctrine\Tests\Orm214\Rector\Param\ReplaceLifecycleEventArgsByDedicatedEventArgsRector\Fixture;

use Doctrine\ORM\Event\PrePersistEventArgs;

class
PrePersistExample
{
    public function prePersist(PrePersistEventArgs $args)
    {
        // ...
    }
}
