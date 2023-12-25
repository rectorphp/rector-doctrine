<?php

declare(strict_types=1);

namespace Utils\Rector\Rector;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Comments\NodeDocBlock\DocBlockUpdater;
use Rector\Core\Contract\Rector\ConfigurableRectorInterface;
use Rector\Core\Exception\ShouldNotHappenException;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use Utils\Rector\AnnotationTransformer\ClassAnnotationTransformer\EntityClassAnnotationTransformer;
use Utils\Rector\AnnotationTransformer\ClassAnnotationTransformer\SoftDeletableClassAnnotationTransformer;
use Utils\Rector\AnnotationTransformer\ClassAnnotationTransformer\TableClassAnnotationTransformer;
use Utils\Rector\AnnotationTransformer\PropertyAnnotationTransformer\ColumnAnnotationTransformer;
use Utils\Rector\AnnotationTransformer\PropertyAnnotationTransformer\EmbeddedPropertyAnnotationTransformer;
use Utils\Rector\AnnotationTransformer\PropertyAnnotationTransformer\GedmoTimestampableAnnotationTransformer;
use Utils\Rector\AnnotationTransformer\PropertyAnnotationTransformer\IdAnnotationTransformer;
use Utils\Rector\AnnotationTransformer\PropertyAnnotationTransformer\IdColumnAnnotationTransformer;
use Utils\Rector\AnnotationTransformer\PropertyAnnotationTransformer\IdGeneratorAnnotationTransformer;
use Utils\Rector\AnnotationTransformer\PropertyAnnotationTransformer\ManyToOneAnnotationTransformer;
use Utils\Rector\AnnotationTransformer\PropertyAnnotationTransformer\OneToManyAnnotationTransformer;
use Utils\Rector\Contract\ClassAnnotationTransformerInterface;
use Utils\Rector\Contract\PropertyAnnotationTransformerInterface;
use Utils\Rector\EntityMappingResolver;
use Utils\Rector\ValueObject\EntityMapping;
use Webmozart\Assert\Assert;

/**
 * @see \Utils\Rector\Tests\Rector\YamlToAnnotationsDoctrineMappingRector\YamlToAnnotationsDoctrineMappingRectorTest
 */
final class YamlToAnnotationsDoctrineMappingRector extends AbstractRector implements ConfigurableRectorInterface
{
    private PhpDocInfoFactory $phpDocInfoFactory;

    private DocBlockUpdater $docBlockUpdater;

    /**
     * @var string[]
     */
    private array $yamlMappingDirectories = [];

    /**
     * @var ClassAnnotationTransformerInterface[]
     */
    private array $classAnnotationTransformers = [];

    /**
     * @var PropertyAnnotationTransformerInterface[]
     */
    private array $propertyAnnotationTransformers = [];

    private EntityMappingResolver $entityMappingResolver;

    public function __construct(
        PhpDocInfoFactory $phpDocInfoFactory,
        DocBlockUpdater $docBlockUpdater,
        EntityClassAnnotationTransformer $entityClassAnnotationTransformer,
        TableClassAnnotationTransformer $tableClassAnnotationTransformer,
        EntityMappingResolver $entityMappingResolver,
        ColumnAnnotationTransformer $columnAnnotationTransformer,
        GedmoTimestampableAnnotationTransformer $gedmoTimestampableAnnotationTransformer,
        ManyToOneAnnotationTransformer $manyToOneAnnotationTransformer,
        OneToManyAnnotationTransformer $oneToManyAnnotationTransformer,
        SoftDeletableClassAnnotationTransformer $softDeletableClassAnnotationTransformer,
        IdAnnotationTransformer $idAnnotationTransformer,
        IdColumnAnnotationTransformer $idColumnAnnotationTransformer,
        IdGeneratorAnnotationTransformer $idGeneratorAnnotationTransformer,
        EmbeddedPropertyAnnotationTransformer $embeddedPropertyAnnotationTransformer
    ) {
        // 1. first class
        $this->classAnnotationTransformers = [
            $tableClassAnnotationTransformer,
            $entityClassAnnotationTransformer,
            $softDeletableClassAnnotationTransformer,
        ];

        // 2. second properties
        $this->propertyAnnotationTransformers = [
            $idAnnotationTransformer,
            $columnAnnotationTransformer,
            $manyToOneAnnotationTransformer,
            $oneToManyAnnotationTransformer,
            $gedmoTimestampableAnnotationTransformer,
            $idColumnAnnotationTransformer,
            $idGeneratorAnnotationTransformer,
            $embeddedPropertyAnnotationTransformer,
        ];

        $this->phpDocInfoFactory = $phpDocInfoFactory;
        $this->docBlockUpdater = $docBlockUpdater;
        $this->entityMappingResolver = $entityMappingResolver;
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Converts YAML Doctrine Entity mapping to particular annotation mapping', [
            // ...
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
                'You forgot to set YAML entity mapping directories. Use $rectorConfig->ruleWithConfiguration() and pass paths as 2nd arguments'
            );
        }

        $entityMapping = $this->findEntityMapping($node);
        if (! $entityMapping instanceof EntityMapping) {
            return null;
        }

        // 1. handle class
        $this->refactorClass($node, $entityMapping);

        // 2. handle properties
        $this->refactorProperties($node, $entityMapping);

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

    private function refactorClass(Class_ $class, EntityMapping $entityMapping): void
    {
        $classPhpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($class);

        foreach ($this->classAnnotationTransformers as $classAnnotationTransformer) {
            $classAnnotationTransformer->transform($entityMapping, $classPhpDocInfo);
        }

        $this->docBlockUpdater->updateRefactoredNodeWithPhpDocInfo($class);
    }

    private function refactorProperties(Class_ $class, EntityMapping $entityMapping): void
    {
        foreach ($class->getProperties() as $property) {
            $propertyPhpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);

            foreach ($this->propertyAnnotationTransformers as $propertyAnnotationTransformer) {
                $propertyAnnotationTransformer->transform($entityMapping, $propertyPhpDocInfo, $property);
            }

            $this->docBlockUpdater->updateRefactoredNodeWithPhpDocInfo($property);
        }
    }
}
