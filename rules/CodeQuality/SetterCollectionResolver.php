<?php

namespace Rector\Doctrine\CodeQuality;

use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Property;
use PHPStan\PhpDocParser\Ast\PhpDoc\VarTagValueNode;
use PHPStan\Reflection\Php\PhpPropertyReflection;
use PHPStan\Type\Type;
use Rector\Doctrine\TypeAnalyzer\CollectionVarTagValueNodeResolver;
use Rector\NodeManipulator\AssignManipulator;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\Reflection\ReflectionResolver;
use Rector\StaticTypeMapper\StaticTypeMapper;

final readonly class SetterCollectionResolver
{
    public function __construct(
        private AssignManipulator $assignManipulator,
        private ReflectionResolver $reflectionResolver,
        private NodeNameResolver $nodeNameResolver,
        private CollectionVarTagValueNodeResolver $collectionVarTagValueNodeResolver,
        private StaticTypeMapper $staticTypeMapper,
    ) {
    }

    public function resolveAssignedType(Class_ $class, ClassMethod $classMethod): ?Type
    {
        $propertyFetches = $this->assignManipulator->resolveAssignsToLocalPropertyFetches($classMethod);
        if (count($propertyFetches) !== 1) {
            return null;
        }

        $phpPropertyReflection = $this->reflectionResolver->resolvePropertyReflectionFromPropertyFetch(
            $propertyFetches[0]
        );
        if (! $phpPropertyReflection instanceof PhpPropertyReflection) {
            return null;
        }

        $propertyName = (string) $this->nodeNameResolver->getName($propertyFetches[0]);
        $property = $class->getProperty($propertyName);

        if (! $property instanceof Property) {
            return null;
        }

        $varTagValueNode = $this->collectionVarTagValueNodeResolver->resolve($property);
        if (! $varTagValueNode instanceof VarTagValueNode) {
            return null;
        }

        return $this->staticTypeMapper->mapPHPStanPhpDocTypeNodeToPHPStanType($varTagValueNode->type, $property);
    }
}
