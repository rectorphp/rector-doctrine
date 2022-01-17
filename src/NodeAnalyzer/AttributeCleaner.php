<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeAnalyzer;

use PhpParser\Node;
use PhpParser\Node\Attribute;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt\ClassLike;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Property;
use Rector\NodeNameResolver\NodeNameResolver;

final class AttributeCleaner
{
    public function __construct(
        private readonly AttributeFinder $attributeFinder,
        private readonly NodeNameResolver $nodeNameResolver,
    ) {
    }

    public function clearAttributeAndArgName(
        ClassMethod | Property | ClassLike | Param $node,
        string $attributeClass,
        string $argName
    ): void {
        $attribute = $this->attributeFinder->findAttributeByClass($node, $attributeClass);
        if (! $attribute instanceof Attribute) {
            return;
        }

        foreach ($attribute->args as $key => $arg) {
            if (! $arg->name instanceof Node) {
                continue;
            }

            if (! $this->nodeNameResolver->isName($arg->name, $argName)) {
                continue;
            }

            // remove attribute
            unset($attribute->args[$key]);
        }
    }
}
