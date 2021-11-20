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

#[MongoDB\EmbeddedDocument]
class Address
{
}

class User
{
    #[MongoDB\EmbedOne(targetDocument: 'Address')]
    private $address;

    #[MongoDB\EmbedMany(targetDocument: 'Address')]
    private $addresses;
}

?>
