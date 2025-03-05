<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM219Set\Fixture;

use Doctrine\ORM\Mapping\SequenceGenerator;

class User
{
    /**
     * @SequenceGenerator(sequenceName="tablename_seq", initialValue=1, allocationSize=100)
     */
    protected $id = null;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\DoctrineORM219Set\Fixture;

use Doctrine\ORM\Mapping\SequenceGenerator;

class User
{
    #[SequenceGenerator(sequenceName: 'tablename_seq', initialValue: 1, allocationSize: 100)]
    protected $id = null;
}

?>
