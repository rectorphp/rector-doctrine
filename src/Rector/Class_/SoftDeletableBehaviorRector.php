<?php

declare(strict_types=1);

namespace Rector\Doctrine\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Stmt\Class_;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDocManipulator\PhpDocTagRemover;
use Rector\Core\NodeManipulator\ClassInsertManipulator;
use Rector\Core\Rector\AbstractRector;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see https://github.com/Atlantic18/DoctrineExtensions/blob/v2.4.x/doc/softdeleteable.md
 * @see https://github.com/KnpLabs/DoctrineBehaviors/blob/4e0677379dd4adf84178f662d08454a9627781a8/docs/soft-deletable.md
 *
 * @see \Rector\Doctrine\Tests\Rector\Class_\SoftDeletableBehaviorRector\SoftDeletableBehaviorRectorTest
 */
final class SoftDeletableBehaviorRector extends AbstractRector
{
    /**
     * @var ClassInsertManipulator
     */
    private $classInsertManipulator;

    /**
     * @var PhpDocTagRemover
     */
    private $phpDocTagRemover;

    public function __construct(ClassInsertManipulator $classInsertManipulator, PhpDocTagRemover $phpDocTagRemover)
    {
        $this->classInsertManipulator = $classInsertManipulator;
        $this->phpDocTagRemover = $phpDocTagRemover;
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Change SoftDeletable from gedmo/doctrine-extensions to knplabs/doctrine-behaviors',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=true)
 */
class SomeClass
{
    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }
}
CODE_SAMPLE
,
                    <<<'CODE_SAMPLE'
use Knp\DoctrineBehaviors\Contract\Entity\SoftDeletableInterface;
use Knp\DoctrineBehaviors\Model\SoftDeletable\SoftDeletableTrait;

class SomeClass implements SoftDeletableInterface
{
    use SoftDeletableTrait;
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
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($node);

        $doctrineAnnotationTagValueNode = $phpDocInfo->getByAnnotationClass(
            'Gedmo\Mapping\Annotation\SoftDeleteable'
        );

        if (! $doctrineAnnotationTagValueNode instanceof DoctrineAnnotationTagValueNode) {
            return null;
        }

        $fieldName = $doctrineAnnotationTagValueNode->getValueWithoutQuotes('fieldName');
        $this->removePropertyAndClassMethods($node, $fieldName);

        $this->classInsertManipulator->addAsFirstTrait(
            $node,
            'Knp\DoctrineBehaviors\Model\SoftDeletable\SoftDeletableTrait'
        );

        $node->implements[] = new FullyQualified('Knp\DoctrineBehaviors\Contract\Entity\SoftDeletableInterface');

        $this->phpDocTagRemover->removeTagValueFromNode($phpDocInfo, $doctrineAnnotationTagValueNode);

        return $node;
    }

    private function removePropertyAndClassMethods(Class_ $class, string $fieldName): void
    {
        // remove property
        foreach ($class->getProperties() as $property) {
            if (! $this->isName($property, $fieldName)) {
                continue;
            }

            $this->removeNode($property);
        }

        // remove methods
        $setMethodName = 'set' . ucfirst($fieldName);
        $getMethodName = 'get' . ucfirst($fieldName);

        foreach ($class->getMethods() as $classMethod) {
            if (! $this->isNames($classMethod, [$setMethodName, $getMethodName])) {
                continue;
            }

            $this->removeNode($classMethod);
        }
    }
}
