<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeManipulator;

use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Expression;
use Rector\NodeManipulator\ClassInsertManipulator;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Rector\PhpParser\Node\NodeFactory;
use Rector\ValueObject\MethodName;

final class ConstructorManipulator
{
    public function __construct(
        private readonly NodeFactory $nodeFactory,
        private readonly ClassInsertManipulator $classInsertManipulator
    ) {
    }

    public function addStmtToConstructor(Class_ $class, Expression $newExpression): void
    {
        $constructClassMethod = $class->getMethod(MethodName::CONSTRUCT);
        if ($constructClassMethod instanceof ClassMethod) {
            $constructClassMethod->stmts[] = $newExpression;
        } else {
            $constructClassMethod = $this->nodeFactory->createPublicMethod(MethodName::CONSTRUCT);
            $constructClassMethod->stmts[] = $newExpression;
            $this->classInsertManipulator->addAsFirstMethod($class, $constructClassMethod);

            $class->setAttribute(AttributeKey::ORIGINAL_NODE, null);
        }
    }
}
