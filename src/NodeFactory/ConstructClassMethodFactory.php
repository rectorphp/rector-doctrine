<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeFactory;

use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Expression;
use PhpParser\Node\Stmt\Property;
use Rector\Core\ValueObject\MethodName;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\NodeTypeResolver\NodeTypeResolver;
use Rector\StaticTypeMapper\StaticTypeMapper;
use Symplify\Astral\ValueObject\NodeBuilder\MethodBuilder;

final class ConstructClassMethodFactory
{
    public function __construct(
        private NodeNameResolver $nodeNameResolver,
        private NodeTypeResolver $nodeTypeResolver,
        private StaticTypeMapper $staticTypeMapper,
    ) {
    }

    public function createFromPublicClassProperties(Class_ $class): ?ClassMethod
    {
        $publicProperties = $this->resolvePublicProperties($class);
        if ($publicProperties === []) {
            return null;
        }

        $params = [];
        $assigns = [];

        foreach ($publicProperties as $publicProperty) {
            /** @var string $propertyName */
            $propertyName = $this->nodeNameResolver->getName($publicProperty);

            $params[] = $this->createParam($publicProperty, $propertyName);
            $assigns[] = $this->createAssign($propertyName);
        }

        $methodBuilder = new MethodBuilder(MethodName::CONSTRUCT);
        $methodBuilder->makePublic();
        $methodBuilder->addParams($params);
        $methodBuilder->addStmts($assigns);

        return $methodBuilder->getNode();
    }

    /**
     * @return Property[]
     */
    private function resolvePublicProperties(Class_ $class): array
    {
        $publicProperties = [];

        foreach ($class->getProperties() as $property) {
            if (! $property->isPublic()) {
                continue;
            }

            $publicProperties[] = $property;
        }

        return $publicProperties;
    }

    private function createAssign(string $name): Expression
    {
        $propertyFetch = new PropertyFetch(new Variable('this'), $name);
        $variable = new Variable($name);
        $assign = new Assign($propertyFetch, $variable);

        return new Expression($assign);
    }

    private function createParam(Property $property, string $propertyName): Param
    {
        $propertyType = $this->nodeTypeResolver->resolve($property);
        $propertyTypeNode = $this->staticTypeMapper->mapPHPStanTypeToPhpParserNode($propertyType);

        $paramVariable = new Variable($propertyName);
        $param = new Param($paramVariable);
        $param->type = $propertyTypeNode;

        return $param;
    }
}
