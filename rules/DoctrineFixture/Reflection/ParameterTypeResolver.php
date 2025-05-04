<?php

declare(strict_types=1);

namespace Rector\Doctrine\DoctrineFixture\Reflection;

use PhpParser\Node\Expr\MethodCall;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Type\ObjectType;
use PHPStan\Type\TypeCombinator;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\NodeTypeResolver\NodeTypeResolver;
use Rector\PHPStan\ScopeFetcher;

final readonly class ParameterTypeResolver
{
    public function __construct(
        private ReflectionProvider $reflectionProvider,
        private NodeNameResolver $nodeNameResolver,
        private NodeTypeResolver $nodeTypeResolver
    ) {
    }

    public function resolveCallerFirstParameterObjectType(MethodCall $methodCall): ?ObjectType
    {
        $callerType = $this->nodeTypeResolver->getType($methodCall->var);
        if (! $callerType instanceof ObjectType) {
            return null;
        }

        if (! $this->reflectionProvider->hasClass($callerType->getClassName())) {
            return null;
        }

        $callerClassReflection = $this->reflectionProvider->getClass($callerType->getClassName());
        $callerMethodName = $this->nodeNameResolver->getName($methodCall->name);
        if (! is_string($callerMethodName)) {
            return null;
        }

        $scope = ScopeFetcher::fetch($methodCall);
        $extendedMethodReflection = $callerClassReflection->getMethod($callerMethodName, $scope);

        $extendedParametersAcceptor = ParametersAcceptorSelector::combineAcceptors(
            $extendedMethodReflection->getVariants()
        );
        $firstParameter = $extendedParametersAcceptor->getParameters()[0];

        $parameterType = $firstParameter->getType();
        $parameterType = TypeCombinator::removeNull($parameterType);

        if (! $parameterType instanceof ObjectType) {
            return null;
        }

        return $parameterType;
    }
}
