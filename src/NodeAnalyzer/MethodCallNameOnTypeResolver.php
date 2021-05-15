<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeAnalyzer;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Type\ObjectType;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\NodeTypeResolver\NodeTypeResolver;
use Symplify\Astral\NodeTraverser\SimpleCallableNodeTraverser;

final class MethodCallNameOnTypeResolver
{
    public function __construct(
        private NodeNameResolver $nodeNameResolver,
        private SimpleCallableNodeTraverser $simpleCallableNodeTraverser,
        private NodeTypeResolver $nodeTypeResolver
    ) {
    }

    /**
     * @return string[]
     */
    public function resolve(Node $node, ObjectType $objectType): array
    {
        $methodNames = [];

        $this->simpleCallableNodeTraverser->traverseNodesWithCallable($node, function (Node $node) use (
            &$methodNames,
            $objectType
        ) {
            if (! $node instanceof MethodCall) {
                return null;
            }

            if (! $this->nodeTypeResolver->isObjectType($node->var, $objectType)) {
                return null;
            }

            $name = $this->nodeNameResolver->getName($node->name);
            if ($name === null) {
                return null;
            }

            $methodNames[] = $name;
        });

        return array_unique($methodNames);
    }
}
