<?php

declare(strict_types=1);

namespace Rector\Doctrine\Orm30\Rector\MethodCall;

use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\ArrayItem;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Scalar\LNumber;
use PHPStan\Type\ObjectType;
use Rector\Contract\PhpParser\Node\StmtsAwareInterface;
use Rector\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see https://github.com/doctrine/orm/pull/9490
 * @see https://github.com/doctrine/orm/blob/3.0.x/UPGRADE.md#query-querybuilder-and-nativequery-parameters-bc-break
 */
final class SetParametersArrayToCollectionRector extends AbstractRector
{
    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Change the argument type for setParameters from array to ArrayCollection and Parameter calls',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
                $entityManager->createQueryBuilder()->setParameters([
                    'foo' => 'bar'
                ]);
                CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
                $entityManager->createQueryBuilder()->setParameters(new \Doctrine\Common\Collections\ArrayCollection([
                    new \Doctrine\ORM\Query\Parameter('foo', 'bar')
                ]));
                CODE_SAMPLE
                )]
        );
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [Node\Stmt\ClassMethod::class, MethodCall::class];
    }

    /**
     * @param Node\Stmt\ClassMethod|MethodCall $node
     */
    public function refactor(Node $node): Node|null
    {
        if ($node instanceof Node\Stmt\ClassMethod) {
            $variables = $this->getAffectedVariables($node);
            foreach ($variables as $variable) {
                $this->iterateThroughStmts($node->getStmts(), $variable);
            }

            return $node;
        }

        return $this->refactorMethodCall($node);
    }

    /**
     * @param list<Node\Stmt> $stmts
     */
    public function iterateThroughStmts(array $stmts, Node\Expr\Variable $variable): void
    {
        foreach ($stmts as $stmt) {
            if ($stmt instanceof StmtsAwareInterface) {
                $this->iterateThroughStmts($stmt->stmts, $variable);
                continue;
            }

            if (
                $stmt->expr instanceof Node\Expr\Assign
                && $stmt->expr->expr instanceof Array_
                && $stmt->expr->var->name === $variable->name
            ) {
                $newCollection = new New_(new FullyQualified('Doctrine\\Common\\Collections\\ArrayCollection'));
                $newCollection->args = [new Arg(new Array_($this->convertArrayToParameters($stmt->expr->expr)))];
                $stmt->expr->expr = $newCollection;
            }

            if (
                $stmt->expr instanceof Node\Expr\Assign
                && $stmt->expr->var instanceof Node\Expr\ArrayDimFetch
                && $stmt->expr->var->var->name === $variable->name
            ) {
                $newParameter = new New_(new FullyQualified('Doctrine\\ORM\\Query\\Parameter'));
                $newParameter->args = [new Arg($stmt->expr->var->dim), new Arg($stmt->expr->expr)];

                $stmt->expr = new MethodCall($stmt->expr->var->var, 'add', [new Arg($newParameter)]);
            }
        }
    }

    /**
     * @return list<Node\Expr\Variable>
     */
    private function getAffectedVariables(Node\Stmt\ClassMethod $classMethod): iterable
    {
        foreach ($classMethod->getStmts() as $stmt) {
            if (
                $stmt instanceof Node\Stmt\Expression
                && $stmt->expr instanceof MethodCall
                && $stmt->expr->args[0]?->value instanceof Node\Expr\Variable
                && $stmt->expr->name->name === 'setParameters'
            ) {
                $varType = $this->nodeTypeResolver->getType($stmt->expr->var);
                if (! $varType->isInstanceOf('Doctrine\\ORM\\QueryBuilder')->yes()) {
                    continue;
                }
                yield $stmt->expr->args[0]->value;
            }
        }
    }

    private function refactorMethodCall(MethodCall $node): Node|null
    {
        $varType = $this->nodeTypeResolver->getType($node->var);

        if (! $varType instanceof ObjectType) {
            return null;
        }

        if (! $varType->isInstanceOf('Doctrine\\ORM\\QueryBuilder')->yes()) {
            return null;
        }

        if ($node->isFirstClassCallable()) {
            return null;
        }

        if (! $this->isNames($node->name, ['setParameters'])) {
            return null;
        }

        $args = $node->getArgs();
        if (\count($args) !== 1) {
            return null;
        }

        $currentArg = $args[0]->value;
        $isAlreadyAnArrayCollection = false;

        $currentArgType = $this->nodeTypeResolver->getType($currentArg);
        if (
            $currentArgType instanceof ObjectType
            && $currentArgType->isInstanceOf('Doctrine\\Common\\Collections\\ArrayCollection')
                ->yes()
            && $currentArg instanceof New_
            && count($currentArg->args) === 1
            && $currentArg->args[0] instanceof Arg
        ) {
            $currentArg = $currentArg->args[0]->value;
            $isAlreadyAnArrayCollection = true;
        }

        if (! $currentArg instanceof Array_) {
            return null;
        }

        $changedParameterType = false;
        $parameters = $this->convertArrayToParameters($currentArg, $changedParameterType);

        if ($changedParameterType === false && $isAlreadyAnArrayCollection) {
            return null;
        }

        $newCollection = new New_(new FullyQualified('Doctrine\\Common\\Collections\\ArrayCollection'));
        $newCollection->args = [new Arg(new Array_($parameters))];

        $node->args = [new Arg($newCollection)];
        return $node;
    }

    private function convertArrayToParameters(Array_ $array, &$changedParameterType = false): array
    {
        $parameters = [];
        foreach ($array->items as $index => $value) {
            if (! $value instanceof ArrayItem) {
                continue;
            }

            $arrayValueType = $this->nodeTypeResolver->getType($value->value);
            if (! $arrayValueType instanceof ObjectType || ! $arrayValueType->isInstanceOf(
                'Doctrine\\ORM\\Query\\Parameter'
            )->yes()) {
                $newParameter = new New_(new FullyQualified('Doctrine\\ORM\\Query\\Parameter'));
                $newParameter->args = [new Arg($value->key ?? new LNumber($index)), new Arg($value->value)];
                $value->value = $newParameter;
                $changedParameterType = true;
            }

            $parameters[] = new ArrayItem($value->value);
        }
        return $parameters;
    }
}
