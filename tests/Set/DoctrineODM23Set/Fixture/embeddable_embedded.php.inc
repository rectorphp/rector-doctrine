<?php

namespace Rector\Doctrine\Tests\Set\DoctrineODM23Set\Fixture;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\EmbeddedDocument
 */
class Address
{
}

class User
{
    /**
     * @MongoDB\EmbedOne(targetDocument="Address")
     */
    private $address;

    /**
     * @MongoDB\EmbedMany(targetDocument="Address")
     */
    private $addresses;
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\Set\DoctrineODM23Set\Fixture;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

#[\Doctrine\ODM\MongoDB\Mapping\Annotations\EmbeddedDocument]
class Address
{
}

class User
{
    #[\Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedOne(targetDocument: 'Address')]
    private $address;

    #[\Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedMany(targetDocument: 'Address')]
    private $addresses;
}

?>
