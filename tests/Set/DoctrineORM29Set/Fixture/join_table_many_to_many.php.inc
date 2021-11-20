<?php
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinTable;

class User
{
    /**
     * @ManyToMany(targetEntity="Phonenumber")
     * @JoinTable(name="users_phonenumbers")
     */
    public $phonenumbers;
}

?>
-----
<?php
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\JoinTable;

class User
{
    #[ManyToMany(targetEntity: 'Phonenumber')]
    #[JoinTable(name: 'users_phonenumbers')]
    public $phonenumbers;
}

?>
