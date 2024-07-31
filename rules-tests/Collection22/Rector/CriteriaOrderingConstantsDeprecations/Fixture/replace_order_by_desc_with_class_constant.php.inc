<?php

namespace Rector\Doctrine\Tests\Collection22\Rector\CriteriaOrderingConstantsDeprecations\Fixture;

use Doctrine\ORM\Mapping as ORM;

class ReplaceOrderByAscWithClassConstant
{
    #[ORM\OrderBy(['createdAt' => 'desc'])]
    protected \DateTimeInterface $messages;
}
?>
