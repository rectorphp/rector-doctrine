<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Fixture\ODM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Source\TrainingTerm;

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

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Fixture\ODM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Source\TrainingTerm;

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
