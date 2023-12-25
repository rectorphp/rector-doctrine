<?php

declare(strict_types=1);

namespace Utils\Rector\Contract;

use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Utils\Rector\ValueObject\EntityMapping;

interface ClassAnnotationTransformerInterface extends AnnotationTransformerInterface
{
    public function transform(EntityMapping $entityMapping, PhpDocInfo $propertyPhpDocInfo): void;
}
