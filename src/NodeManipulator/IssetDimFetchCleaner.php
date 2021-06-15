<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeManipulator;

use PhpParser\Node\Expr\ArrayDimFetch;
use PhpParser\Node\Expr\BooleanNot;
use PhpParser\Node\Expr\Isset_;
use PhpParser\Node\Expr\Throw_;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\If_;
use PhpParser\Node\Stmt\Throw_ as ThrowStmt;
use Rector\Core\PhpParser\Comparing\NodeComparator;
use Rector\Core\PhpParser\Node\BetterNodeFinder;
use Rector\Core\PhpParser\Node\Value\ValueResolver;
use Rector\Doctrine\ValueObject\OptionalAndRequiredParamNames;
use Rector\NodeRemoval\NodeRemover;
use Rector\NodeTypeResolver\Node\AttributeKey;

final class IssetDimFetchCleaner
{
    public function __construct(
        private BetterNodeFinder $betterNodeFinder,
        private ValueResolver $valueResolver,
        private NodeComparator $nodeComparator,
        private NodeRemover $nodeRemover
    ) {
    }

    public function clearArrayDimFetchIssetAndReturnRequiredParams(
        ClassMethod $classMethod,
        Variable $paramVariable
    ): OptionalAndRequiredParamNames {
        $requiredParamNames = [];
        $optionalParamName = [];

        foreach ((array) $classMethod->stmts as $stmt) {
            if (! $stmt instanceof If_) {
                continue;
            }

            /** @var If_ $if */
            $if = $stmt;

            /** @var Isset_|null $isset */
            $isset = $this->betterNodeFinder->findFirstInstanceOf($if->cond, Isset_::class);
            if (! $isset instanceof Isset_) {
                continue;
            }

            $issetParent = $isset->getAttribute(AttributeKey::PARENT_NODE);
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
                $this->nodeRemover->removeNode($if);
                if ($arrayDimFetch->dim === null) {
                    continue;
                }

                $dimValue = $this->valueResolver->getValue($arrayDimFetch->dim);
                if ($dimValue === null) {
                    continue;
                }

                // is required or optional?
                if ($issetParent instanceof BooleanNot) {
                    // contains exception? required param
                    if ($this->betterNodeFinder->hasInstancesOf($if, [Throw_::class, ThrowStmt::class])) {
                        $requiredParamNames[] = $dimValue;
                        continue;
                    }
                }

                // else optional param
                $optionalParamName[] = $dimValue;
            }
        }

        return new OptionalAndRequiredParamNames($optionalParamName, $requiredParamNames);
    }
}
