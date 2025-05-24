<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteParamDocblockFromToManyRector\Source;

use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteParamDocblockFromToManyRector\Source\ValueObject\DoctrineType;

final class TrainingWithIntegerIdAttributeConstantFetch
{
    #[ORM\Column(name: 'id', type: DoctrineType::STRING)]
    #[ORM\Id]
    private string $id;

    #[ORM\Column(name: 'id2', type: DoctrineType::INTEGER)]
    #[ORM\Id]
    private int $id2;
}
