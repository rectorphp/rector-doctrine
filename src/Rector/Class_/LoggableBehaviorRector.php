<?php

declare(strict_types=1);

namespace Rector\Doctrine\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDoc\SpacelessPhpDocTagNode;
use Rector\Core\NodeManipulator\ClassInsertManipulator;
use Rector\Core\Rector\AbstractRector;
use Symplify\Astral\PhpDocParser\PhpDocNodeTraverser;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see https://github.com/Atlantic18/DoctrineExtensions/blob/v2.4.x/doc/loggable.md
 * @see https://github.com/KnpLabs/DoctrineBehaviors/blob/4e0677379dd4adf84178f662d08454a9627781a8/docs/loggable.md
 *
 * @see \Rector\Doctrine\Tests\Rector\Class_\LoggableBehaviorRector\LoggableBehaviorRectorTest
 */
final class LoggableBehaviorRector extends AbstractRector
{
    public function __construct(
        private readonly ClassInsertManipulator $classInsertManipulator,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Change Loggable from gedmo/doctrine-extensions to knplabs/doctrine-behaviors',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @Gedmo\Loggable
 */
class SomeClass
{
    /**
     * @Gedmo\Versioned
     * @ORM\Column(name="title", type="string", length=8)
     */
    private $title;
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model\Loggable\LoggableTrait;
use Knp\DoctrineBehaviors\Contract\Entity\LoggableInterface;

/**
 * @ORM\Entity
 */
class SomeClass implements LoggableInterface
{
    use LoggableTrait;

    /**
     * @ORM\Column(name="title", type="string", length=8)
     */
    private $title;
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
        return [Class_::class, Property::class];
    }

    /**
     * @param Class_|Property $node
     */
    public function refactor(Node $node): ?Node
    {
        if ($node instanceof Class_) {
            return $this->refactorClass($node);
        }

        return $this->refactorProperty($node);
    }

    private function refactorClass(Class_ $class): Class_ | null
    {
        // change the node
        $classPhpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($class);

        $hasLoggableAnnotation = false;

        $phpDocNodeTraverser = new PhpDocNodeTraverser();
        $phpDocNodeTraverser->traverseWithCallable($classPhpDocInfo->getPhpDocNode(), '', function ($node) use (
            &$hasLoggableAnnotation
        ): ?int {
            if (! $node instanceof SpacelessPhpDocTagNode) {
                return null;
            }

            if (! $node->value instanceof DoctrineAnnotationTagValueNode) {
                return null;
            }

            $doctrineAnnotationTagValueNode = $node->value;
            if (! $doctrineAnnotationTagValueNode->hasClassName('Gedmo\Mapping\Annotation\Loggable')) {
                return null;
            }

            $hasLoggableAnnotation = true;

            return PhpDocNodeTraverser::NODE_REMOVE;
        });

        if (! $hasLoggableAnnotation) {
            return null;
        }

        // invoke phpdoc re-print as annotation was removed
        $classPhpDocInfo->markAsChanged();

        $this->classInsertManipulator->addAsFirstTrait($class, 'Knp\DoctrineBehaviors\Model\Loggable\LoggableTrait');
        $class->implements[] = new FullyQualified('Knp\DoctrineBehaviors\Contract\Entity\LoggableInterface');

        return $class;
    }

    private function refactorProperty(Property $property): ?Property
    {
        // remove tag from properties
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);

        $hasChanged = false;

        $phpDocNodeTraverser = new PhpDocNodeTraverser();
        $phpDocNodeTraverser->traverseWithCallable($phpDocInfo->getPhpDocNode(), '', function ($node) use (
            $phpDocInfo,
            &$hasChanged
        ): ?int {
            if (! $node instanceof SpacelessPhpDocTagNode) {
                return null;
            }

            if (! $node->value instanceof DoctrineAnnotationTagValueNode) {
                return null;
            }

            if (! $node->value->hasClassName('Gedmo\Mapping\Annotation\Versioned')) {
                return null;
            }

            $phpDocInfo->markAsChanged();
            $hasChanged = true;

            return PhpDocNodeTraverser::NODE_REMOVE;
        });

        if (! $hasChanged) {
            return null;
        }

        return $property;
    }
}
