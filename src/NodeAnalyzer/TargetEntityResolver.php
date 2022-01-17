<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeAnalyzer;

use PhpParser\Node\Expr;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Scalar\String_;
use Rector\Core\Exception\NotImplementedYetException;
use Rector\NodeNameResolver\NodeNameResolver;

final class TargetEntityResolver
{
    public function __construct(
        private readonly NodeNameResolver $nodeNameResolver
    ) {
    }

    public function resolveFromExpr(Expr $targetEntityExpr): string|null
    {
        if ($targetEntityExpr instanceof ClassConstFetch) {
            return $this->nodeNameResolver->getName($targetEntityExpr->class);
        }

        if ($targetEntityExpr instanceof String_) {
            return $targetEntityExpr->value;
        }

        $errorMessage = sprintf('Add support for "%s" targetEntity in "%s"', $targetEntityExpr::class, self::class);
        throw new NotImplementedYetException($errorMessage);
    }
}
