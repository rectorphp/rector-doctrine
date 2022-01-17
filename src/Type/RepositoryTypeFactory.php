<?php

declare(strict_types=1);

namespace Rector\Doctrine\Type;

use PhpParser\Node\Expr;
use PhpParser\Node\Expr\ClassConstFetch;
use PHPStan\Type\Generic\GenericObjectType;
use Rector\Core\Exception\NotImplementedYetException;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\StaticTypeMapper\ValueObject\Type\FullyQualifiedObjectType;

final class RepositoryTypeFactory
{
    public function __construct(
        private readonly NodeNameResolver $nodeNameResolver
    ) {
    }

    public function createRepositoryPropertyType(Expr $entityReferenceExpr): GenericObjectType
    {
        if (! $entityReferenceExpr instanceof ClassConstFetch) {
            throw new NotImplementedYetException();
        }

        /** @var string $className */
        $className = $this->nodeNameResolver->getName($entityReferenceExpr->class);

        return new GenericObjectType('Doctrine\ORM\EntityRepository', [new FullyQualifiedObjectType($className)]);
    }
}
