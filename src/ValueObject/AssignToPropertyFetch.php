<?php

declare(strict_types=1);

namespace Rector\Doctrine\ValueObject;

use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\PropertyFetch;

final class AssignToPropertyFetch
{
    public function __construct(
        private Assign $assign,
        private PropertyFetch $propertyFetch,
        private string $propertyName
    ) {
    }

    public function getAssign(): Assign
    {
        return $this->assign;
    }

    public function getPropertyFetch(): PropertyFetch
    {
        return $this->propertyFetch;
    }

    public function getPropertyName(): string
    {
        return $this->propertyName;
    }
}
