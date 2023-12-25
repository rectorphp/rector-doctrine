<?php

declare(strict_types=1);

namespace Utils\Rector\Contract;

use PhpParser\Node\Stmt\Property;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Utils\Rector\ValueObject\EntityMapping;

interface PropertyAnnotationTransformerInterface extends AnnotationTransformerInterface
{
    public function transform(EntityMapping $entityMapping, PhpDocInfo $propertyPhpDocInfo, Property $property): void;
}
