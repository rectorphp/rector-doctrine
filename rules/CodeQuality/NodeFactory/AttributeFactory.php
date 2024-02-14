<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\NodeFactory;

use PhpParser\BuilderHelpers;
use PhpParser\Node\Arg;
use PhpParser\Node\Attribute;
use PhpParser\Node\AttributeGroup;
use PhpParser\Node\Expr;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name\FullyQualified;

final class AttributeFactory
{
    public static function createNamedArg(mixed $expr, string $name): Arg
    {
        if (! $expr instanceof Expr) {
            $expr = BuilderHelpers::normalizeValue($expr);
        }

        return new Arg($expr, false, false, [], new Identifier($name));
    }

    /**
     * @param Arg[] $args
     */
    public static function createGroup(string $className, array $args = []): AttributeGroup
    {
        $attribute = self::createFromClassName($className);
        $attribute->args = $args;

        return new AttributeGroup([$attribute]);
    }

    public static function createFromClassName(string $className): Attribute
    {
        return new Attribute(new FullyQualified($className));
    }
}
