<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source;

use Doctrine\ORM\Mapping as ORM;

final class TrainingWithIntegerIdAttribute
{
    #[ORM\Column(name: 'id', type: 'integer')]
    #[ORM\Id]
    private int $id;
}
