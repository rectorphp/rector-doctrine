<?php

class DummyEntity {

    #[ORM\OneToMany(targetEntity: AnotherEntity::class, mappedBy: 'dummy')]
    #[ORM\OrderBy(["id" => \Doctrine\Common\Collections\Criteria::ASC])]
    public \Doctrine\Common\Collections\Collection $properties;

    #[ORM\OneToMany(targetEntity: YetAnotherEntity::class, mappedBy: 'dummy')]
    #[ORM\OrderBy(["id" => \Doctrine\Common\Collections\Criteria::DESC])]
    public \Doctrine\Common\Collections\Collection $otherProperties;
}
?>
-----
<?php

class DummyEntity {

    #[ORM\OneToMany(targetEntity: AnotherEntity::class, mappedBy: 'dummy')]
    #[ORM\OrderBy(["id" => 'ASC'])]
    public \Doctrine\Common\Collections\Collection $properties;

    #[ORM\OneToMany(targetEntity: YetAnotherEntity::class, mappedBy: 'dummy')]
    #[ORM\OrderBy(["id" => 'DESC'])]
    public \Doctrine\Common\Collections\Collection $otherProperties;
}
?>
