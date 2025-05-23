<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Fixture\ManyToMany;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\CountryRef;

#[ORM\Entity]
class SkipCollectionGenericClass
{
	/**
	 * @var Collection<int, CountryRef>
	 */
	#[ORM\ManyToMany(mappedBy: 'country', targetEntity: CountryRef::class, cascade: ['persist'])]
	private Collection $countryRefs;

	public function __construct()
	{
		$this->countryRefs = new ArrayCollection();
	}
}
