<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use Rector\Core\Contract\Rector\ConfigurableRectorInterface;
use Rector\Core\Exception\ShouldNotHappenException;
use Rector\Core\Rector\AbstractRector;

// @todo pass with iterator

//use Rector\Doctrine\CodeQuality\AnnotationTransformer\ClassAnnotationTransformer\EntityClassAnnotationTransformer;
//use Rector\Doctrine\CodeQuality\AnnotationTransformer\ClassAnnotationTransformer\SoftDeletableClassAnnotationTransformer;
//use Rector\Doctrine\CodeQuality\AnnotationTransformer\ClassAnnotationTransformer\TableClassAnnotationTransformer;
//use Rector\Doctrine\CodeQuality\AnnotationTransformer\PropertyAnnotationTransformer\ColumnAnnotationTransformer;
//use Rector\Doctrine\CodeQuality\AnnotationTransformer\PropertyAnnotationTransformer\EmbeddedPropertyAnnotationTransformer;
//use Rector\Doctrine\CodeQuality\AnnotationTransformer\PropertyAnnotationTransformer\GedmoTimestampableAnnotationTransformer;
//use Rector\Doctrine\CodeQuality\AnnotationTransformer\PropertyAnnotationTransformer\IdAnnotationTransformer;
//use Rector\Doctrine\CodeQuality\AnnotationTransformer\PropertyAnnotationTransformer\IdColumnAnnotationTransformer;
//use Rector\Doctrine\CodeQuality\AnnotationTransformer\PropertyAnnotationTransformer\IdGeneratorAnnotationTransformer;
//use Rector\Doctrine\CodeQuality\AnnotationTransformer\PropertyAnnotationTransformer\ManyToOneAnnotationTransformer;
//use Rector\Doctrine\CodeQuality\AnnotationTransformer\PropertyAnnotationTransformer\OneToManyAnnotationTransformer;
use Rector\Doctrine\CodeQuality\AnnotationTransformer\YamlToAnnotationTransformer;
use Rector\Doctrine\CodeQuality\EntityMappingResolver;
use Rector\Doctrine\CodeQuality\ValueObject\EntityMapping;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use Webmozart\Assert\Assert;

/**
 * @see \Rector\Doctrine\Tests\CodeQuality\Rector\Class_\YamlToAnnotationsDoctrineMappingRector\YamlToAnnotationsDoctrineMappingRectorTest
 */
final class YamlToAnnotationsDoctrineMappingRector extends AbstractRector implements ConfigurableRectorInterface
{
    /**
     * @var string[]
     */
    private array $yamlMappingDirectories = [];

    public function __construct(
        private readonly EntityMappingResolver $entityMappingResolver,
        private readonly YamlToAnnotationTransformer $yamlToAnnotationTransformer,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Converts YAML Doctrine Entity mapping to particular annotation mapping', [
            // ...
            // @todo add example
        ]);
    }

    public function getNodeTypes(): array
    {
        return [Class_::class];
    }

    /**
     * @param Class_ $node
     */
    public function refactor(Node $node): ?Class_
    {
        if ($this->yamlMappingDirectories === []) {
            throw new ShouldNotHappenException(
                'First, set directories with YAML entity mapping. Use $rectorConfig->ruleWithConfiguration() and pass paths as 2nd argument'
            );
        }

        $entityMapping = $this->findEntityMapping($node);
        if (! $entityMapping instanceof EntityMapping) {
            return null;
        }

        $this->yamlToAnnotationTransformer->transform($node, $entityMapping);

        return $node;
    }

    /**
     * @param mixed[] $configuration
     */
    public function configure(array $configuration): void
    {
        Assert::allString($configuration);
        Assert::allFileExists($configuration);

        $this->yamlMappingDirectories = $configuration;
    }

    private function findEntityMapping(Class_ $class): ?EntityMapping
    {
        $className = $this->getName($class);
        if (! is_string($className)) {
            return null;
        }

        $entityMappings = $this->entityMappingResolver->resolveFromDirectories($this->yamlMappingDirectories);

        foreach ($entityMappings as $entityMapping) {
            if ($entityMapping->getClassName() !== $className) {
                continue;
            }

            return $entityMapping;
        }

        return null;
    }
}
