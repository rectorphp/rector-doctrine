<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\Enum;

use Deprecated;

/**
 * @deprecated Switch to @see \Rector\Doctrine\Enum\DoctrineClass instead
 * @api
 */
final readonly class DoctrineClass
{
    #[Deprecated(message: 'BC only')]
    public const string COLLECTION = \Rector\Doctrine\Enum\DoctrineClass::COLLECTION;
}
