<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Fixture\ODM;

use Doctrine\Common\Collections\ArrayCollection;
use Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Source\TrainingTerm;

final class WithDefaultNullAssignedNonConstruct
{
    /**
     * @\Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedMany(targetDocument="TrainingTerm")
     */
    private $trainingTerms = null;

    public function run()
    {
        $this->trainingTerms = new ArrayCollection();
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Fixture\ODM;

use Doctrine\Common\Collections\ArrayCollection;
use Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Source\TrainingTerm;

final class WithDefaultNullAssignedNonConstruct
{
    /**
     * @\Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedMany(targetDocument="TrainingTerm")
     * @var \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromToManyRelationTypeRector\Source\TrainingTerm>
     */
    private ?\Doctrine\Common\Collections\Collection $trainingTerms = null;

    public function run()
    {
        $this->trainingTerms = new ArrayCollection();
    }
}

?>
