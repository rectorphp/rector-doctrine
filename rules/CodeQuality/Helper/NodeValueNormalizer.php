<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\Helper;

use PhpParser\Node\Arg;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Scalar\String_;

final class NodeValueNormalizer
{
    //    public static function normalize(mixed $value): mixed
    //    {
    //        if (is_bool($value)) {
    //            return $value ? 'true' : 'false';
    //        }
    //
    //        if (is_numeric($value)) {
    //            return $value;
    //        }
    //
    //        return new StringNode($value);
    //    }

    /**
     * @param Arg[] $args
     */
    public static function ensureKeyIsClassConstFetch(array $args, string $argumentName): void
    {
        foreach ($args as $arg) {
            if (! $arg->name instanceof Identifier) {
                continue;
            }

            if ($arg->name->toString() !== $argumentName) {
                continue;
            }

            // already done
            if ($arg->value instanceof ClassConstFetch) {
                continue;
            }

            $value = $arg->value;

            // we need string reference
            if (! $value instanceof String_) {
                continue;
            }

            $arg->value = new ClassConstFetch(new FullyQualified($value->value), new Identifier('class'));
        }
    }
}
