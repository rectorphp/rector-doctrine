<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector\Fixture\OneToMany;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training;

/**
 * @ORM\Entity
 */
final class Trainer
{
    /**
     * @ORM\OneToMany(targetEntity=Training::class, mappedBy="trainer")
     */
    private $trainings;

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __isset($name)
    {
        return isset($this->$name);
    }

    public function getTrainings(): Collection
    {
        return $this->trainings;
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector\Fixture\OneToMany;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Rector\Doctrine\Tests\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training;

/**
 * @ORM\Entity
 */
final class Trainer
{
    /**
     * @ORM\OneToMany(targetEntity=Training::class, mappedBy="trainer")
     */
    private $trainings;

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __isset($name)
    {
        return isset($this->$name);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\TypedCollections\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training>
     */
    public function getTrainings(): Collection
    {
        return $this->trainings;
    }
}

?>
