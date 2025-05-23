<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source;

final class TrainingWithIntegerId
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private int $id;
}
