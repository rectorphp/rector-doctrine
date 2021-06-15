<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeFactory;

use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Param;
use Rector\Core\Exception\ShouldNotHappenException;
use Rector\Doctrine\ValueObject\AssignToPropertyFetch;
use Rector\NodeNameResolver\NodeNameResolver;
use Rector\NodeTypeResolver\NodeTypeResolver;
use Rector\StaticTypeMapper\StaticTypeMapper;

final class ParamFactory
{
    public function __construct(
        private NodeTypeResolver $nodeTypeResolver,
        private StaticTypeMapper $staticTypeMapper,
        private NodeNameResolver $nodeNameResolver,
    ) {
    }

    /**
     * @param AssignToPropertyFetch[] $assignsToPropertyFetch
     * @return Param[]
     */
    public function createFromAssignsToPropertyFetch(array $assignsToPropertyFetch): array
    {
        $params = [];
        foreach ($assignsToPropertyFetch as $assignToPropertyFetch) {
            $propertyFetch = $assignToPropertyFetch->getPropertyFetch();
            $params[] = $this->createFromPropertyFetch($propertyFetch);
        }

        return $params;
    }

    public function createFromPropertyFetch(PropertyFetch $propertyFetch): Param
    {
        $propertyName = $this->nodeNameResolver->getName($propertyFetch->name);
        if ($propertyName === null) {
            throw new ShouldNotHappenException();
        }

        $variable = new Variable($propertyName);

        $param = new Param($variable);

        $paramType = $this->nodeTypeResolver->getStaticType($propertyFetch);
        $param->type = $this->staticTypeMapper->mapPHPStanTypeToPhpParserNode($paramType);

        return $param;
    }
}
