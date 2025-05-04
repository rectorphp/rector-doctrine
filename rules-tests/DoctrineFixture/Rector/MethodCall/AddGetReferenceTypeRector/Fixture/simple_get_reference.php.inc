<?php

namespace Rector\Doctrine\Tests\DoctrineFixture\Rector\MethodCall\AddGetReferenceTypeRector\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Rector\Doctrine\Tests\DoctrineFixture\Rector\MethodCall\AddGetReferenceTypeRector\Source\SomeEntity;

final class SimpleGetReference extends AbstractFixture
{
    public function run(SomeEntity $someEntity)
    {
        $someEntity->setSomePassedEntity(
            $this->getReference('some-id')
        );
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\DoctrineFixture\Rector\MethodCall\AddGetReferenceTypeRector\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Rector\Doctrine\Tests\DoctrineFixture\Rector\MethodCall\AddGetReferenceTypeRector\Source\SomeEntity;

final class SimpleGetReference extends AbstractFixture
{
    public function run(SomeEntity $someEntity)
    {
        $someEntity->setSomePassedEntity(
            $this->getReference('some-id', \Rector\Doctrine\Tests\DoctrineFixture\Rector\MethodCall\AddGetReferenceTypeRector\Source\SomePassedEntity::class)
        );
    }
}

?>
