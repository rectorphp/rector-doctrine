<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAttributeDoctrineMappingRector\Fixture;

#[\Doctrine\ORM\Mapping\Entity(repositoryClass: \App\Repository\SomeRepository::class)]
#[\Doctrine\ORM\Mapping\Table(name: 'transaction')]
final class BareClass
{
}
