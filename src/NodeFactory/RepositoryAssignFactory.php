<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeFactory;

use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Stmt\Class_;
use PHPStan\Type\TypeWithClassName;
use Rector\Core\Exception\ShouldNotHappenException;
use Rector\Core\PhpParser\Node\NodeFactory;
use Rector\Doctrine\NodeAnalyzer\EntityObjectTypeResolver;
use Rector\NodeNameResolver\NodeNameResolver;

final class RepositoryAssignFactory
{
    public function __construct(
        private readonly EntityObjectTypeResolver $entityObjectTypeResolver,
        private readonly NodeNameResolver $nodeNameResolver,
        private readonly NodeFactory $nodeFactory
    ) {
    }

    /**
     * Creates: "$this->repository = $entityManager->getRepository(SomeEntityClass::class)"
     */
    public function create(Class_ $repositoryClass): Assign
    {
        $entityObjectType = $this->entityObjectTypeResolver->resolveFromRepositoryClass($repositoryClass);

        $className = $this->nodeNameResolver->getName($repositoryClass);
        if (! is_string($className)) {
            throw new ShouldNotHappenException();
        }

        $repositoryClassName = $className;

        if (! $entityObjectType instanceof TypeWithClassName) {
            throw new ShouldNotHappenException(sprintf(
                'An entity was not found for "%s" repository.',
                $repositoryClassName,
            ));
        }

        $classConstFetch = $this->nodeFactory->createClassConstReference($entityObjectType->getClassName());

        $methodCall = $this->nodeFactory->createMethodCall('entityManager', 'getRepository', [$classConstFetch]);

        return $this->nodeFactory->createPropertyAssignmentWithExpr('repository', $methodCall);
    }
}
