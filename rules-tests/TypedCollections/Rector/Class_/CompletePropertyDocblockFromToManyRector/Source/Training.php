<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompletePropertyDocblockFromToManyRector\Source;

final class Training
{
    /**
     * @ORM\Column(name="id", type="string")
     * @ORM\Id
     */
    private string $id;
}
