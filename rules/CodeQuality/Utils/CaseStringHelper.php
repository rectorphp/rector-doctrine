<?php

declare(strict_types=1);

namespace Utils\Rector\Utils;

final class CaseStringHelper
{
    public static function camelCase(string $value): string
    {
        $output = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $value))));

        return preg_replace('#\W#', '', $output);
    }
}
