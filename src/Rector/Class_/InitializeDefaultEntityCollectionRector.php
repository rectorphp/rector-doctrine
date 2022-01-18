<?php

declare(strict_types=1);

namespace Rector\Doctrine\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Expression;
use Rector\Core\NodeManipulator\ClassDependencyManipulator;
use Rector\Core\Rector\AbstractRector;
use Rector\Doctrine\NodeAnalyzer\AttrinationFinder;
use Rector\Doctrine\NodeFactory\ArrayCollectionAssignFactory;
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
     * @var class-string[]
     */
    private const TO_MANY_ANNOTATION_CLASSES = [
        'Doctrine\ORM\Mapping\OneToMany',
        'Doctrine\ORM\Mapping\ManyToMany',
    ];

    public function __construct(
        private readonly ClassDependencyManipulator $classDependencyManipulator,
        private readonly ArrayCollectionAssignFactory $arrayCollectionAssignFactory,
        private readonly AttrinationFinder $attrinationFinder,
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

        if (! $this->attrinationFinder->hasByOne($node, 'Doctrine\ORM\Mapping\Entity')) {
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

            if (! $this->attrinationFinder->hasByMany($property, self::TO_MANY_ANNOTATION_CLASSES)) {
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
}
