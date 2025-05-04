<?php

namespace Rector\Doctrine\Tests\DoctrineFixture\Rector\MethodCall\AddGetReferenceTypeRector\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Rector\Doctrine\Tests\DoctrineFixture\Rector\MethodCall\AddGetReferenceTypeRector\Source\SomeEntity;

final class SkipOutsideGetter extends AbstractFixture
{
    public function run(SomeEntity $someEntity)
    {
        $unableToResolve = $this->getReference('some-id');
        $someEntity->setSomePassedEntity(
            $unableToResolve
        );
    }
}
