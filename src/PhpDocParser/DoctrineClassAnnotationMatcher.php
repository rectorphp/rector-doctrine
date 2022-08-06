<?php

declare(strict_types=1);

namespace Rector\Doctrine\PhpDocParser;

use PhpParser\Node\Stmt\Property;
use Rector\BetterPhpDocParser\PhpDocParser\ClassAnnotationMatcher;

class DoctrineClassAnnotationMatcher
{
    public function __construct(private readonly ClassAnnotationMatcher $classAnnotationMatcher)
    {
    }

    public function resolveExpectingDoctrineFQCN(string $value, Property $property): ?string
    {
        $fullyQualified = $this->classAnnotationMatcher->resolveTagToKnownFullyQualifiedName($value, $property);

        if ($fullyQualified === null) {
            // Doctrine FQCNs are strange: In their examples
            // they omit the leading slash. This leads to
            // ClassAnnotationMatcher searching in the wrong
            // namespace. Therefor we try to add the leading
            // slash manually here.
            $fullyQualified = $this->classAnnotationMatcher->resolveTagToKnownFullyQualifiedName(
                '\\' . $value,
                $property
            );
        }

        return $fullyQualified;
    }
}
