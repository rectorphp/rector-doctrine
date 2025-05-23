<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Fixture\ODM;

use Doctrine\Common\Collections\Collection;

final class CollectionOfSuperClass
{
    /**
     * @\Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedMany()
     */
    private ?Collection $trainingTerms = null;

    public function __construct()
    {
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Fixture\ODM;

use Doctrine\Common\Collections\Collection;

final class CollectionOfSuperClass
{
    /**
     * @\Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedMany()
     * @var \Doctrine\Common\Collections\Collection
     */
    private \Doctrine\Common\Collections\Collection $trainingTerms;

    public function __construct()
    {
    }
}

?>
