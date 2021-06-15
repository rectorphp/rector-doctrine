<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeManipulator;

use PhpParser\Node\Expr\ArrayDimFetch;
use PhpParser\Node\Expr\Isset_;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\If_;
use Rector\Core\PhpParser\Comparing\NodeComparator;
use Rector\Core\PhpParser\Node\BetterNodeFinder;
use Rector\Core\PhpParser\Node\Value\ValueResolver;
use Rector\NodeRemoval\NodeRemover;

final class IssetDimFetchCleaner
{
    public function __construct(
        private BetterNodeFinder $betterNodeFinder,
        private ValueResolver $valueResolver,
        private NodeComparator $nodeComparator,
        private NodeRemover $nodeRemover
    ) {
    }

    /**
     * @return string[]
     */
    public function clearArrayDimFetchIssetAndReturnRequiredParams(
        ClassMethod $classMethod,
        Variable $paramVariable
    ): array {
        $requiredParams = [];

        foreach ((array) $classMethod->stmts as $stmt) {
            if (! $stmt instanceof If_) {
                continue;
            }

            /** @var Isset_|null $isset */
            $isset = $this->betterNodeFinder->findFirstInstanceOf($stmt->cond, Isset_::class);
            if (! $isset instanceof Isset_) {
                continue;
            }

            foreach ($isset->vars as $var) {
                if (! $var instanceof ArrayDimFetch) {
                    continue;
                }

                /** @var ArrayDimFetch $arrayDimFetch */
                $arrayDimFetch = $var;

                if (! $this->nodeComparator->areNodesEqual($paramVariable, $arrayDimFetch->var)) {
                    continue;
                }

                // remove if stmt, this check is not part of __constuct() contract
                $this->nodeRemover->removeNode($stmt);

                if ($arrayDimFetch->dim === null) {
                    continue;
                }

                $dimValue = $this->valueResolver->getValue($arrayDimFetch->dim);
                if ($dimValue === null) {
                    continue;
                }

                $requiredParams[] = $dimValue;
            }
        }

        return $requiredParams;
    }
}
