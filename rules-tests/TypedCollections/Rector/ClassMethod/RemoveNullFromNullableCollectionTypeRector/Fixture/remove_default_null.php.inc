<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\RemoveNullFromNullableCollectionTypeRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;

final class RemoveDefaultNull
{
    /**
     * @MongoDB\EmbedMany()
     * @var Collection<int, string>|null
     * @Assert\Valid()
     */
    private ?Collection $collection = null;

    public function __construct()
    {
        $this->collection = new ArrayCollection([]);
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\RemoveNullFromNullableCollectionTypeRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;

final class RemoveDefaultNull
{
    /**
     * @MongoDB\EmbedMany()
     * @var Collection<int, string>|null
     * @Assert\Valid()
     */
    private Collection $collection;

    public function __construct()
    {
        $this->collection = new ArrayCollection([]);
    }
}

?>
