<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeAnalyzer;

use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\Reflection\ReflectionProvider;
use Rector\NodeAnalyzer\DoctrineEntityAnalyzer;

/**
 * @api Part of external API
 */
final readonly class DoctrineEntityDetector
{
    public function __construct(
        private DoctrineEntityAnalyzer $doctrineEntityAnalyzer,
        private ReflectionProvider $reflectionProvider,
    ) {
    }

    public function detect(Class_ $class): bool
    {
        // A. check static function mapping, fields are mapped in loadMetadata() method
        // @see https://www.doctrine-project.org/projects/doctrine-orm/en/3.6/reference/php-mapping.html#static-function
        if ($class->getMethod('loadMetadata') instanceof ClassMethod) {
            return true;
        }

        // B. check annotations
        if ($this->doctrineEntityAnalyzer->hasClassAnnotation($class)) {
            return true;
        }

        if (! $class->namespacedName instanceof Name) {
            return false;
        }

        $className = $class->namespacedName->toString();

        // C. check attributes
        $classReflection = $this->reflectionProvider->getClass($className);

        return $this->doctrineEntityAnalyzer->hasClassReflectionAttribute($classReflection);
    }
}
