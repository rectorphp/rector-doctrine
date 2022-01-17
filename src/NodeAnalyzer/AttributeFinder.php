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
     * @param class-string $attributeClass
     */
    public function findAttributeByClassArgByName(
        ClassMethod | Property | ClassLike | Param $node,
        string $attributeClass,
        string $argName
    ): ?Expr {
        return $this->findAttributeByClassesArgByName($node, [$attributeClass], $argName);
    }

    /**
     * @param class-string[] $attributeClasses
     */
    public function findAttributeByClassesArgByName(
        ClassMethod | Property | ClassLike | Param $node,
        array $attributeClasses,
        string $argName
    ): ?Expr {
        $attribute = $this->findAttributeByClasses($node, $attributeClasses);
        if (! $attribute instanceof Attribute) {
            return null;
        }

        return $this->findArgByName($attribute, $argName);
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

    /**
     * @param class-string $attributeClass
     */
    public function findAttributeByClass(
        ClassMethod | Property | ClassLike | Param $node,
        string $attributeClass
    ): ?Attribute {
        /** @var AttributeGroup $attrGroup */
        foreach ($node->attrGroups as $attrGroup) {
            foreach ($attrGroup->attrs as $attribute) {
                if (! $attribute->name instanceof FullyQualified) {
                    continue;
                }

                if ($this->nodeNameResolver->isName($attribute->name, $attributeClass)) {
                    return $attribute;
                }
            }
        }

        return null;
    }

    /**
     * @param class-string[] $attributeClasses
     */
    private function findAttributeByClasses(
        ClassMethod | Property | ClassLike | Param $node,
        array $attributeClasses
    ): ?Attribute {
        foreach ($attributeClasses as $attributeClass) {
            $attribute = $this->findAttributeByClass($node, $attributeClass);
            if ($attribute instanceof Attribute) {
                return $attribute;
            }
        }

        return null;
    }
}
