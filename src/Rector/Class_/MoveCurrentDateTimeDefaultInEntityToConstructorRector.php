<?php

declare(strict_types=1);

namespace Rector\Doctrine\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;
use Rector\Core\Rector\AbstractRector;
use Rector\Doctrine\NodeAnalyzer\ConstructorAssignPropertyAnalyzer;
use Rector\Doctrine\NodeFactory\ValueAssignFactory;
use Rector\Doctrine\NodeManipulator\ColumnDatetimePropertyManipulator;
use Rector\Doctrine\NodeManipulator\ConstructorManipulator;
use Rector\Doctrine\PhpDoc\Node\Property_\ColumnTagValueNode;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see https://stackoverflow.com/a/7698687/1348344
 *
 * @see \Rector\Doctrine\Tests\Rector\Class_\MoveCurrentDateTimeDefaultInEntityToConstructorRector\MoveCurrentDateTimeDefaultInEntityToConstructorRectorTest
 */
final class MoveCurrentDateTimeDefaultInEntityToConstructorRector extends AbstractRector
{
    /**
     * @var ConstructorManipulator
     */
    private $constructorManipulator;

    /**
     * @var ValueAssignFactory
     */
    private $valueAssignFactory;

    /**
     * @var ColumnDatetimePropertyManipulator
     */
    private $columnDatetimePropertyManipulator;

    /**
     * @var ConstructorAssignPropertyAnalyzer
     */
    private $constructorAssignPropertyAnalyzer;

    public function __construct(
        ConstructorManipulator $constructorManipulator,
        ValueAssignFactory $valueAssignFactory,
        ColumnDatetimePropertyManipulator $columnDatetimePropertyManipulator,
        ConstructorAssignPropertyAnalyzer $constructorAssignPropertyAnalyzer
    ) {
        $this->constructorManipulator = $constructorManipulator;
        $this->valueAssignFactory = $valueAssignFactory;
        $this->columnDatetimePropertyManipulator = $columnDatetimePropertyManipulator;
        $this->constructorAssignPropertyAnalyzer = $constructorAssignPropertyAnalyzer;
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Move default value for entity property to constructor, the safest place',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class User
{
    /**
     * @var DateTimeInterface
     *
     * @ORM\Column(type="datetime", nullable=false, options={"default"="now()"})
     */
    private $when = 'now()';
}
CODE_SAMPLE

                    ,
                    <<<'CODE_SAMPLE'
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class User
{
    /**
     * @var DateTimeInterface
     *
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $when;

    public function __construct()
    {
        $this->when = new \DateTime();
    }
}
CODE_SAMPLE
            ),
            ]);
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
        foreach ($node->getProperties() as $property) {
            $this->refactorProperty($property, $node);
        }

        return $node;
    }

    private function refactorProperty(Property $property, Class_ $class): ?Property
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);

        $columnTagValueNode = $phpDocInfo->getByType(ColumnTagValueNode::class);
        if (! $columnTagValueNode instanceof ColumnTagValueNode) {
            return null;
        }

        /** @var ColumnTagValueNode $columnTagValueNode */
        if ($columnTagValueNode->getType() !== 'datetime') {
            return null;
        }

        $constructorAssign = $this->constructorAssignPropertyAnalyzer->resolveConstructorAssign($property);

        // 0. already has default
        if ($constructorAssign !== null) {
            return null;
        }

        // 1. remove default options from database level
        $this->columnDatetimePropertyManipulator->removeDefaultOption($columnTagValueNode);
        $phpDocInfo->markAsChanged();
        $this->refactorClass($class, $property);

        // 3. remove default from property
        $onlyProperty = $property->props[0];
        $onlyProperty->default = null;

        return $property;
    }

    private function refactorClass(Class_ $class, Property $property): void
    {
        /** @var string $propertyName */
        $propertyName = $this->getName($property);
        $onlyProperty = $property->props[0];

        $defaultExpr = $onlyProperty->default;
        if (! $defaultExpr instanceof Expr) {
            return;
        }

        $expression = $this->valueAssignFactory->createDefaultDateTimeWithValueAssign($propertyName, $defaultExpr);
        $this->constructorManipulator->addStmtToConstructor($class, $expression);
    }
}
