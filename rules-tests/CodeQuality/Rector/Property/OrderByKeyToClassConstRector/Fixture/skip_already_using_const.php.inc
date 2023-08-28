<?php

namespace Rector\Doctrine\Tests\CodeQuality\Rector\Property\OrderByKeyToClassConstRector\Fixture;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;

class SkipAlreadyUsingConst
{
    #[ORM\OrderBy(['createdAt' => Criteria::ASC])]
    protected \DateTimeInterface $messages;
}
?>
