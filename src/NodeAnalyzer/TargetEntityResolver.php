<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeAnalyzer;

use PhpParser\Node\Attribute;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Identifier;
use PhpParser\Node\Scalar\String_;
use PHPStan\Reflection\ReflectionProvider;
use Rector\Doctrine\CodeQuality\Enum\EntityMappingKey;
use Rector\Exception\NotImplementedYetException;
use Rector\NodeNameResolver\NodeNameResolver;

final readonly class TargetEntityResolver
{
    public function __construct(
        private NodeNameResolver $nodeNameResolver,
        private ReflectionProvider $reflectionProvider
    ) {
    }

    public function resolveFromAttribute(Attribute $attribute): ?string
    {
        foreach ($attribute->args as $arg) {
            if (! $arg->name instanceof Identifier) {
                continue;
            }

            if ($arg->name->toString() !== EntityMappingKey::TARGET_ENTITY) {
                continue;
            }

            return $this->resolveFromExpr($arg->value);
        }

        return null;
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
