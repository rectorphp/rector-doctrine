<?php

declare(strict_types=1);

namespace Rector\Doctrine\TypedCollections\Rector\ClassMethod;

use PhpParser\Node;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Expression;
use Rector\Doctrine\Enum\DoctrineClass;
use Rector\Rector\AbstractRector;
use Rector\ValueObject\MethodName;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\RemoveNewArrayCollectionOutsideConstructorRector\RemoveNewArrayCollectionOutsideConstructorRectorTest
 */
final class RemoveNewArrayCollectionOutsideConstructorRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Remove new ArrayCollection() assigns outside constructor', [
            new CodeSample(
                <<<'CODE_SAMPLE'
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class NoAssignOutsideConstructor
{
    public Collection $items;

    public function anotherMethod()
    {
        $this->items = new ArrayCollection();
    }
}
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
namespace Rector\Doctrine\Tests\TypedCollections\Rector\ClassMethod\RemoveNewArrayCollectionOutsideConstructorRector\Fixture;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class NoAssignOutsideConstructor
{
    public Collection $items;

    public function anotherMethod()
    {
    }
}
CODE_SAMPLE
            )]);
    }

    public function getNodeTypes(): array
    {
        return [ClassMethod::class];
    }

    /**
     * @param ClassMethod $node
     */
    public function refactor(Node $node): ?ClassMethod
    {
        if ($node->isAbstract()) {
            return null;
        }

        $hasChanged = false;

        if ($this->isName($node, MethodName::CONSTRUCT)) {
            return null;
        }

        $methodName = $this->getName($node);
        if (str_contains($methodName, 'remove') || str_contains($methodName, 'clear')) {
            return null;
        }

        foreach ((array) $node->stmts as $key => $stmt) {
            if (! $stmt instanceof Expression) {
                continue;
            }

            // only assign of new ArrayCollection
            if (! $stmt->expr instanceof Assign) {
                continue;
            }

            /** @var Assign $assign */
            $assign = $stmt->expr;
            if (! $assign->expr instanceof New_) {
                continue;
            }

            // skip if has some values
            if ($assign->expr->getArgs() !== []) {
                continue;
            }

            $new = $assign->expr;
            if (! $this->isName($new->class, DoctrineClass::ARRAY_COLLECTION)) {
                continue;
            }

            unset($node->stmts[$key]);
            $hasChanged = true;
        }

        if ($hasChanged) {
            return $node;
        }

        return null;
    }
}
