<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector\Fixture\OneToMany;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\CodeQuality\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector\Source\Training;

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

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector\Fixture\OneToMany;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Rector\Doctrine\Tests\CodeQuality\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector\Source\Training;

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
     * @return \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\CodeQuality\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector\Source\Training>
     */
    public function getTrainings(): Collection
    {
        return $this->trainings;
    }
}

?>
