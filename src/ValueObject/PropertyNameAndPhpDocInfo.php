<?php

declare(strict_types=1);

namespace Rector\Doctrine\ValueObject;

use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;

final class PropertyNameAndPhpDocInfo
{
    public function __construct(
        private readonly string $propertyName,
        private readonly PhpDocInfo $phpDocInfo
    ) {
    }

    public function getPropertyName(): string
    {
        return $this->propertyName;
    }

    public function getPhpDocInfo(): PhpDocInfo
    {
        return $this->phpDocInfo;
    }
}
