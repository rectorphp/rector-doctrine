<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Fixture\OneToMany\Attribute;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class SkipCollectionGenericObject
{
    /**
     * @var Collection<int, object>
     */
    #[ORM\OneToMany(mappedBy: 'port', targetEntity: object::class)]
    private Collection $oi;

    public function __construct()
    {
        $this->oi = new ArrayCollection();
    }
}
