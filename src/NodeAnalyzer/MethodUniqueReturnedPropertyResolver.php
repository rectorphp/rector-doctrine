<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeAnalyzer;

use PhpParser\Node\Expr;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Property;
use PhpParser\Node\Stmt\Return_;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\PhpParser\Node\BetterNodeFinder;

final readonly class MethodUniqueReturnedPropertyResolver
{
    public function __construct(
        private BetterNodeFinder $betterNodeFinder,
        private NodeNameResolver $nodeNameResolver
    ) {
    }

    public function resolve(Class_ $class, ClassMethod $classMethod): ?Property
    {
        /** @var Return_[] $returns */
        $returns = $this->betterNodeFinder->findInstancesOfInFunctionLikeScoped($classMethod, Return_::class);

        $return = \reset($returns);

        if (\count($returns) !== 1) {
            return null;
        }

        if (! $return instanceof Return_) {
            return null;
        }

        $returnExpr = $return->expr;

        if (! $returnExpr instanceof PropertyFetch) {
            return null;
        }

        $propertyName = (string) $this->nodeNameResolver->getName($returnExpr);

        return $class->getProperty($propertyName);
    }
}
