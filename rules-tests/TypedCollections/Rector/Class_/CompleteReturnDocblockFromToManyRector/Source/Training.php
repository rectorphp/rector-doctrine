<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteReturnDocblockFromToManyRector\Source;

use Doctrine\ORM\Mapping as ORM;

final class Training
{
    #[ORM\Column(name: 'id', type: 'string')]
    #[ORM\Id]
    private string $id;
}
