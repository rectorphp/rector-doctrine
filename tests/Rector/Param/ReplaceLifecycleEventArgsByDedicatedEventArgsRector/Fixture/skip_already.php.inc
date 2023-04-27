<?php

use Doctrine\ORM\Event\PrePersistEventArgs;

class PrePersistExample
{
    public function prePersist(PrePersistEventArgs $args)
    {
        // ...
    }
}
