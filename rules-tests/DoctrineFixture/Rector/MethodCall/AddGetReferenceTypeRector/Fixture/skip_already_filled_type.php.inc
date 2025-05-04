<?php

namespace Rector\Doctrine\Tests\DoctrineFixture\Rector\MethodCall\AddGetReferenceTypeRector\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Rector\Doctrine\Tests\DoctrineFixture\Rector\MethodCall\AddGetReferenceTypeRector\Source\SomeEntity;
use Rector\Doctrine\Tests\DoctrineFixture\Rector\MethodCall\AddGetReferenceTypeRector\Source\SomePassedEntity;

final class SkipAlreadyFilledType extends AbstractFixture
{
    public function run(SomeEntity $someEntity)
    {
        $someEntity->setSomePassedEntity(
            $this->getReference('some-id', SomePassedEntity::class)
        );
    }
}
