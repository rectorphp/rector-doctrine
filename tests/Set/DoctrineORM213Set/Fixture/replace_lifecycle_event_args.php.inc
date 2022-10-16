<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM213Set\Fixture;

use Doctrine\ORM\Event\LifecycleEventArgs;

final class ReplaceLifecyleEventArgs
{
    public function onFlush(LifecycleEventArgs $args): void
    {
        $object = $args->getEntity();
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM213Set\Fixture;

use Doctrine\ORM\Event\LifecycleEventArgs;

final class ReplaceLifecyleEventArgs
{
    public function onFlush(\Doctrine\Persistence\Event\LifecycleEventArgs $args): void
    {
        $object = $args->getObject();
    }
}

?>
