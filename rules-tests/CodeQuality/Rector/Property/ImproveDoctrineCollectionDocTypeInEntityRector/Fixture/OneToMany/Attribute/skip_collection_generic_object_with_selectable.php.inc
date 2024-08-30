<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Fixture\OneToMany\Attribute;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Selectable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class SkipCollectionGenericObject
{
    /**
     * @var Collection<int, object>&Selectable<int, object>
     */
    #[ORM\OneToMany(mappedBy: 'port', targetEntity: object::class)]
    private Collection&Selectable $oi;

    public function __construct()
    {
        $this->oi = new ArrayCollection();
    }
}
