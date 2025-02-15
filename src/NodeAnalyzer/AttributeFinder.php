<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeAnalyzer;

use PhpParser\Node\Attribute;
use PhpParser\Node\AttributeGroup;
use PhpParser\Node\Expr;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassLike;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Property;
use Rector\Doctrine\Enum\MappingClass;
use Rector\NodeNameResolver\NodeNameResolver;

/**
 * @api
 */
final readonly class AttributeFinder
{
    public function __construct(
        private NodeNameResolver $nodeNameResolver,
    ) {
    }

    /**
     * @param MappingClass::* $attributeClass
     */
    public function findAttributeByClassArgByName(
        ClassMethod | Property | ClassLike | Param $node,
        string $attributeClass,
        string $argName
    ): ?Expr {
        return $this->findAttributeByClassesArgByName($node, [$attributeClass], $argName);
    }

    /**
     * @param string[] $attributeClasses
     * @param string[] $argNames
     */
    public function findAttributeByClassesArgByNames(
        ClassMethod | Property | ClassLike | Param $node,
        array $attributeClasses,
        array $argNames
    ): ?Expr {
        $attribute = $this->findAttributeByClasses($node, $attributeClasses);
        if (! $attribute instanceof Attribute) {
            return null;
        }

        foreach ($argNames as $argName) {
            $argExpr = $this->findArgByName($attribute, $argName);
            if ($argExpr instanceof Expr) {
                return $argExpr;
            }
        }

        return null;
    }

    /**
     * @param string[] $attributeClasses
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
     * @return Attribute[]
     */
    public function findManyByClass(
        ClassMethod | Property | ClassLike | Param $node,
        string $attributeClass
    ): array {
        $attributes = [];

        /** @var AttributeGroup $attrGroup */
        foreach ($node->attrGroups as $attrGroup) {
            foreach ($attrGroup->attrs as $attribute) {
                if (! $attribute->name instanceof FullyQualified) {
                    continue;
                }

                if ($this->nodeNameResolver->isName($attribute->name, $attributeClass)) {
                    $attributes[] = $attribute;
                }
            }
        }

        return $attributes;
    }

    /**
     * @param string[] $attributeClasses
     */
    public function findAttributeByClasses(
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

    /**
     * @param string[] $attributeClasses
     */
    public function hasAttributeByClasses(
        ClassMethod | Property | ClassLike | Param $node,
        array $attributeClasses
    ): bool {
        return $this->findAttributeByClasses($node, $attributeClasses) instanceof Attribute;
    }

    private function findArgByName(Attribute $attribute, string $argName): Expr|null
    {
        foreach ($attribute->args as $arg) {
            if (! $arg->name instanceof Identifier) {
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
     * @param string[] $names
     * @return Attribute[]
     */
    public function findManyByClasses(ClassMethod|Property|Class_|Param $node, array $names): array
    {
        $attributes = [];

        foreach ($names as $name) {
            $justFoundAttributes = $this->findManyByClass($node, $name);
            $attributes = [...$attributes, ...$justFoundAttributes];
        }

        return $attributes;
    }
}
