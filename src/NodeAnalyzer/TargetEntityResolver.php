<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeAnalyzer;

use PhpParser\Node\Expr;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Scalar\String_;
use PHPStan\Reflection\ReflectionProvider;
use Rector\Core\Exception\NotImplementedYetException;
use Rector\NodeNameResolver\NodeNameResolver;

final class TargetEntityResolver
{
    public function __construct(
        private readonly NodeNameResolver $nodeNameResolver,
        private readonly ReflectionProvider $reflectionProvider
    ) {
    }

    public function resolveFromExpr(Expr $targetEntityExpr): string|null
    {
        if ($targetEntityExpr instanceof ClassConstFetch) {
            $targetEntity = (string) $this->nodeNameResolver->getName($targetEntityExpr->class);
            if (! $this->reflectionProvider->hasClass($targetEntity)) {
                return null;
            }

            return $targetEntity;
        }

        if ($targetEntityExpr instanceof String_) {
            $targetEntity = $targetEntityExpr->value;
            if (! $this->reflectionProvider->hasClass($targetEntity)) {
                return null;
            }

            return $targetEntity;
        }

        $errorMessage = sprintf('Add support for "%s" targetEntity in "%s"', $targetEntityExpr::class, self::class);
        throw new NotImplementedYetException($errorMessage);
    }
}
