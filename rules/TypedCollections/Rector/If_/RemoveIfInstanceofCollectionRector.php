<?php

declare(strict_types=1);

namespace Rector\Doctrine\TypedCollections\Rector\If_;

use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\BinaryOp\BooleanAnd;
use PhpParser\Node\Expr\BinaryOp\Coalesce;
use PhpParser\Node\Expr\BinaryOp\Identical;
use PhpParser\Node\Expr\BooleanNot;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\Instanceof_;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Expr\Ternary;
use PhpParser\Node\Stmt\If_;
use PhpParser\NodeVisitorAbstract;
use Rector\Doctrine\TypedCollections\TypeAnalyzer\CollectionTypeDetector;
use Rector\PhpParser\Node\Value\ValueResolver;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Doctrine\Tests\TypedCollections\Rector\If_\RemoveIfInstanceofCollectionRector\RemoveIfInstanceofCollectionRectorTest
 */
final class RemoveIfInstanceofCollectionRector extends AbstractRector
{
    public function __construct(
        private readonly CollectionTypeDetector $collectionTypeDetector,
        private readonly ValueResolver $valueResolver,
    ) {

    }

    public function getNodeTypes(): array
    {
        return [If_::class, Ternary::class, Coalesce::class, BooleanAnd::class, BooleanNot::class];
    }

    /**
     * @param If_|Ternary|Coalesce|BooleanAnd|BooleanNot $node
     * @return Node|Node[]|int|null
     */
    public function refactor(Node $node)
    {
        if ($node instanceof BooleanNot) {
            if ($this->collectionTypeDetector->isCollectionType($node->expr)) {
                return new MethodCall($node->expr, 'isEmpty');
            }

            return null;
        }

        if ($node instanceof BooleanAnd) {
            if ($this->isInstanceofCollectionType($node->left)) {
                return $node->right;
            }

            if ($this->isInstanceofCollectionType($node->right)) {
                return $node->left;
            }

            return null;
        }

        if ($node instanceof Coalesce) {
            if ($this->collectionTypeDetector->isCollectionType($node->left)) {
                return $node->left;
            }

            return null;
        }

        if ($node instanceof If_) {
            return $this->refactorIf($node);
        }

        return $this->refactorTernary($node);
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Remove if instance of collection on already known Collection type', [
            new CodeSample(
                <<<'CODE_SAMPLE'
use Doctrine\Common\Collections\Collection;

final class SomeClass
{
    public ?Collection $items;

    public function someMethod()
    {
        if ($this->items instanceof Collection) {
            $values = $this->items;
        }
    }
}
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
use Doctrine\Common\Collections\Collection;

final class SomeClass
{
    public ?Collection $items;

    public function someMethod()
    {
        $values = $this->items;
    }
}
CODE_SAMPLE
            )]);
    }

    /**
     * @return Node[]|int|Node|null
     */
    private function refactorIf(If_ $if): array|int|null|Node
    {
        if ($if->cond instanceof BooleanNot) {
            $condition = $if->cond->expr;
            if (! $condition instanceof Instanceof_) {
                return null;
            }

            if (! $this->collectionTypeDetector->isCollectionType($condition->expr)) {
                return null;
            }

            return NodeVisitorAbstract::REMOVE_NODE;
        }

        if ($if->cond instanceof Identical) {
            $identical = $if->cond;

            if ($this->valueResolver->isValue($identical->right, false)) {
                if (! $this->isInstanceofCollectionType($identical->left)) {
                    return null;
                }

                return NodeVisitorAbstract::REMOVE_NODE;
            }

            if ($this->isName($identical->right, 'null')) {
                if ($this->collectionTypeDetector->isCollectionType($identical->left)) {
                    $if->cond = new MethodCall($if->cond->left, 'isEmpty');
                    return $if;
                }

                return null;
            }
        }

        // implicit instance of
        if ($if->cond instanceof PropertyFetch && $this->collectionTypeDetector->isCollectionType($if->cond)) {
            return $if->stmts;
        }

        if (! $this->isInstanceofCollectionType($if->cond)) {
            return null;
        }

        return $if->stmts;
    }

    private function refactorTernary(Ternary $ternary): ?Expr
    {
        $isNegated = false;
        if ($this->isInstanceofCollectionType($ternary->cond)) {
            return $ternary->if;
        }

        if ($ternary->cond instanceof Identical && $this->isName($ternary->cond->right, 'false')) {
            $isNegated = true;
            $condition = $ternary->cond->left;
        } else {
            $condition = $ternary->cond;
        }

        if ($this->isIsObjectFuncCallOnCollection($condition)) {
            return $ternary->if;
        }

        return null;
    }

    private function isInstanceofCollectionType(Expr $expr): bool
    {
        if (! $expr instanceof Instanceof_) {
            return false;
        }

        return $this->collectionTypeDetector->isCollectionType($expr->expr);
    }

    private function isIsObjectFuncCallOnCollection(Expr $expr): bool
    {
        if (! $expr instanceof FuncCall) {
            return false;
        }

        if ($expr->isFirstClassCallable()) {
            return false;
        }

        if (! $this->isName($expr->name, 'is_object')) {
            return false;
        }

        $firstArg = $expr->getArgs()[0];

        return $this->collectionTypeDetector->isCollectionType($firstArg->value);
    }
}
