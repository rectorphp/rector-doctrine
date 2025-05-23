<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Fixture\ODM;

use Doctrine\Common\Collections\ArrayCollection;
use Rector\Doctrine\Tests\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Source\TrainingTerm;

final class RemoveDefaultNull
{
    /**
     * @\Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedMany(targetDocument="TrainingTerm")
     */
    private $trainingTerms = null;

    public function __construct()
    {
        $this->trainingTerms = new ArrayCollection();
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Fixture\ODM;

use Doctrine\Common\Collections\ArrayCollection;
use Rector\Doctrine\Tests\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Source\TrainingTerm;

final class RemoveDefaultNull
{
    /**
     * @\Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedMany(targetDocument="TrainingTerm")
     * @var \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Source\TrainingTerm>
     */
    private \Doctrine\Common\Collections\Collection $trainingTerms;

    public function __construct()
    {
        $this->trainingTerms = new ArrayCollection();
    }
}

?>
