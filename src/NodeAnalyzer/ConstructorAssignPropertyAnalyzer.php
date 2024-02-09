<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeAnalyzer;

use PhpParser\Node;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Property;
use Rector\NodeAnalyzer\PropertyFetchAnalyzer;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\PhpParser\Node\BetterNodeFinder;
use Rector\ValueObject\MethodName;

final readonly class ConstructorAssignPropertyAnalyzer
{
    public function __construct(
        private BetterNodeFinder $betterNodeFinder,
        private NodeNameResolver $nodeNameResolver,
        private PropertyFetchAnalyzer $propertyFetchAnalyzer
    ) {
    }

    public function resolveConstructorAssign(Class_ $class, Property $property): ?Node
    {
        $constructClassMethod = $class->getMethod(MethodName::CONSTRUCT);
        if (! $constructClassMethod instanceof ClassMethod) {
            return null;
        }

        /** @var string $propertyName */
        $propertyName = $this->nodeNameResolver->getName($property);

        return $this->betterNodeFinder->findFirst((array) $constructClassMethod->stmts, function (Node $node) use (
            $propertyName
        ): bool {
            if (! $node instanceof Assign) {
                return false;
            }

            return $this->propertyFetchAnalyzer->isLocalPropertyFetchName($node->var, $propertyName);
        });
    }
}
