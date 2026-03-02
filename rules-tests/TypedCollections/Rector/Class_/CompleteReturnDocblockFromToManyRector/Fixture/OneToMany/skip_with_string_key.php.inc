<?php

namespace Rector\Doctrine\Tests\TypedCollections\Rector\Class_\CompleteReturnDocblockFromToManyRector\Fixture\OneToMany;

 use Doctrine\ORM\Mapping as ORM;

 /**
  * @ORM\Entity
  */
 final class Trainer
 {
     /**
      * @ORM\OneToMany(targetEntity=Training::class, indexBy=someField)
      * @var \Doctrine\Common\Collections\Collection<string, Training>
      */
     private $trainings;

     /**
      * @return \Doctrine\Common\Collections\Collection<string, Training>
      */
     public function getTrainings()
     {
         return $this->trainings;
     }
 }