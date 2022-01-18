<?php

declare(strict_types=1);

namespace Rector\Doctrine\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Attribute;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Expression;
use PhpParser\Node\Stmt\Property;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\Core\NodeManipulator\ClassDependencyManipulator;
use Rector\Core\Rector\AbstractRector;
use Rector\Doctrine\NodeAnalyzer\AttributeFinder;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/best-practices.html#initialize-collections-in-the-constructor
 *
 * @see \Rector\Doctrine\Tests\Rector\Class_\InitializeDefaultEntityCollectionRector\InitializeDefaultEntityCollectionRectorTest
 */
final class InitializeDefaultEntityCollectionRector extends AbstractRector
{
    /**
     * @var string
     */
    private const ENTITY_ANNOTATION_CLASS = 'Doctrine\ORM\Mapping\Entity';

    /**
     * @var string[]
     */
    private const TO_MANY_ANNOTATION_CLASSES = [
        'Doctrine\ORM\Mapping\OneToMany',
        'Doctrine\ORM\Mapping\ManyToMany',
    ];

    public function __construct(
        private readonly ClassDependencyManipulator $classDependencyManipulator,
        private readonly AttributeFinder $attributeFinder,
        private \Rector\Doctrine\NodeFactory\ArrayCollectionAssignFactory $arrayCollectionAssignFactory,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Initialize collection property in Entity constructor',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class SomeClass
{
    /**
     * @ORM\OneToMany(targetEntity="MarketingEvent")
     */
    private $marketingEvents = [];
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class SomeClass
{
    /**
     * @ORM\OneToMany(targetEntity="MarketingEvent")
     */
    private $marketingEvents = [];

    public function __construct()
    {
        $this->marketingEvents = new ArrayCollection();
    }
}
CODE_SAMPLE
                ),
            ]
        );
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [Class_::class];
    }

    /**
     * @param Class_ $node
     */
    public function refactor(Node $node): ?Node
    {
        $kind = $node->getAttribute(AttributeKey::KIND);
        if ($kind === 'initialized') {
            return null;
        }

        if (! $this->isEntity($node)) {
            return null;
        }

        return $this->refactorClass($node);
    }

    /**
     * @return string[]
     */
    private function resolveToManyPropertyNames(Class_ $class): array
    {
        $collectionPropertyNames = [];

        foreach ($class->getProperties() as $property) {
            if (count($property->props) !== 1) {
                continue;
            }

            if (! $this->hasPropertyToManyAnnotation($property)) {
                continue;
            }

            /** @var string $propertyName */
            $propertyName = $this->getName($property);
            $collectionPropertyNames[] = $propertyName;
        }

        return $collectionPropertyNames;
    }

    /**
     * @param string[] $propertyNames
     * @return Expression[]
     */
    private function createAssignsOfArrayCollectionsForPropertyNames(array $propertyNames): array
    {
        $assigns = [];
        foreach ($propertyNames as $propertyName) {
            $assigns[] = $this->arrayCollectionAssignFactory->createFromPropertyName($propertyName);
        }

        return $assigns;
    }

    private function refactorClass(Class_ $class): Class_|null
    {
        $toManyPropertyNames = $this->resolveToManyPropertyNames($class);
        if ($toManyPropertyNames === []) {
            return null;
        }

        $assigns = $this->createAssignsOfArrayCollectionsForPropertyNames($toManyPropertyNames);
        $this->classDependencyManipulator->addStmtsToConstructorIfNotThereYet($class, $assigns);

        $class->setAttribute(AttributeKey::KIND, 'initialized');

        return $class;
    }

    private function isEntity(Class_ $class): bool
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNode($class);
        if ($phpDocInfo instanceof PhpDocInfo && $phpDocInfo->hasByAnnotationClass(self::ENTITY_ANNOTATION_CLASS)) {
            return true;
        }

        $attribute = $this->attributeFinder->findAttributeByClass($class, self::ENTITY_ANNOTATION_CLASS);
        return $attribute instanceof Attribute;
    }

    private function hasPropertyToManyAnnotation(Property $property): bool
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNode($property);

        if ($phpDocInfo instanceof PhpDocInfo && $phpDocInfo->hasByAnnotationClasses(
            self::TO_MANY_ANNOTATION_CLASSES
        )) {
            return true;
        }

        $attribute = $this->attributeFinder->findAttributeByClasses($property, self::TO_MANY_ANNOTATION_CLASSES);
        return $attribute instanceof Attribute;
    }
}
