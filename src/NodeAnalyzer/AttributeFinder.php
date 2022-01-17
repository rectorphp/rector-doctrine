<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeAnalyzer;

use PhpParser\Node\Attribute;
use PhpParser\Node\AttributeGroup;
use PhpParser\Node\Expr;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt\ClassLike;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Property;
use Rector\NodeNameResolver\NodeNameResolver;

final class AttributeFinder
{
    public function __construct(
        private readonly NodeNameResolver $nodeNameResolver,
    ) {
    }

    /**
     * @param class-string[] $desiredAttributeClasses
     */
    public function findAttributeByClasses(
        ClassMethod | Property | ClassLike | Param $node,
        array $desiredAttributeClasses
    ): ?Attribute {
        foreach ($desiredAttributeClasses as $desiredAttributeClass) {
            $desiredAttribute = $this->findAttributeByClass($node, $desiredAttributeClass);
            if ($desiredAttribute instanceof Attribute) {
                return $desiredAttribute;
            }
        }

        return null;
    }

    /**
     * @param class-string[] $desiredAttributeClasses
     */
    public function findAttributeByClassesArgByName(
        ClassMethod | Property | ClassLike | Param $node,
        array $desiredAttributeClasses,
        string $argName
    ): ?Expr {
        $attribute = $this->findAttributeByClasses($node, $desiredAttributeClasses);
        if (! $attribute instanceof Attribute) {
            return null;
        }

        return $this->findArgByName($attribute, $argName);
    }

    /**
     * @param class-string $desiredAttributeClass
     */
    public function findAttributeByClass(
        ClassMethod | Property | ClassLike | Param $node,
        string $desiredAttributeClass
    ): ?Attribute {
        /** @var AttributeGroup $attrGroup */
        foreach ($node->attrGroups as $attrGroup) {
            foreach ($attrGroup->attrs as $attribute) {
                if (! $attribute->name instanceof FullyQualified) {
                    continue;
                }

                if ($this->nodeNameResolver->isName($attribute->name, $desiredAttributeClass)) {
                    return $attribute;
                }
            }
        }

        return null;
    }

    public function findArgByName(Attribute $attribute, string $argName): Expr|null
    {
        foreach ($attribute->args as $arg) {
            if ($arg->name === null) {
                continue;
            }

            if (! $this->nodeNameResolver->isName($arg->name, $argName)) {
                continue;
            }

            return $arg->value;
        }

        return null;
    }
}
