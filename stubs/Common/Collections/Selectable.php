<?php

declare(strict_types=1);

namespace Doctrine\Common\Collections;

if (interface_exists('Doctrine\Common\Collections\Selectable')) {
    return;
}

interface Selectable
{
    public function matching(Criteria $criteria);
}
