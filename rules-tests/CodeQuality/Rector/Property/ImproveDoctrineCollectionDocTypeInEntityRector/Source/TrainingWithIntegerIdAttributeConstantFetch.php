<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source;

use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\ValueObject\DoctrineType;

final class TrainingWithIntegerIdAttributeConstantFetch
{
    #[ORM\Column(name: 'id', type: DoctrineType::STRING)]
    #[ORM\Id]
    private string $id;

    #[ORM\Column(name: 'id2', type: DoctrineType::INTEGER)]
    #[ORM\Id]
    private int $id2;
}
