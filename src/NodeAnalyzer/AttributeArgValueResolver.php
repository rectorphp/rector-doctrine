<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeAnalyzer;

use PhpParser\Node\Attribute;
use PhpParser\Node\Expr;
use Rector\NodeNameResolver\NodeNameResolver;

final class AttributeArgValueResolver
{
    public function __construct(
        private readonly NodeNameResolver $nodeNameResolver
    ) {
    }

    public function resolve(Attribute $attribute, string $argName): Expr|null
    {
        foreach ($attribute->args as $arg) {
            if ($arg->name === null) {
                continue;
            }

            if (! $this->nodeNameResolver->isName($arg->name, $argName)) {
                continue;
            }

            return $arg->value;
        }

        return null;
    }
}
