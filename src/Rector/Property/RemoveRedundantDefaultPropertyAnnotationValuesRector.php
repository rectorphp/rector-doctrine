<?php

declare(strict_types=1);

namespace Rector\Doctrine\Rector\Property;

use PhpParser\Node;
use PhpParser\Node\Stmt\Property;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\Core\Rector\AbstractRector;
use Rector\Doctrine\NodeManipulator\DoctrineItemDefaultValueManipulator;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Doctrine\Tests\Rector\Property\RemoveRedundantDefaultPropertyAnnotationValuesRector\RemoveRedundantDefaultPropertyAnnotationValuesRectorTest
 */
final class RemoveRedundantDefaultPropertyAnnotationValuesRector extends AbstractRector
{
    /**
     * @var string
     */
    private const ORPHAN_REMOVAL = 'orphanRemoval';

    /**
     * @var string
     */
    private const FETCH = 'fetch';

    /**
     * @var string
     */
    private const LAZY = 'LAZY';

    public function __construct(
        private DoctrineItemDefaultValueManipulator $doctrineItemDefaultValueManipulator
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Removes redundant default values from Doctrine ORM annotations/attributes properties',
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
     * @ORM\ManyToOne(targetEntity=Training::class)
     * @ORM\JoinColumn(name="training", unique=false)
     */
    private $training;
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
     * @ORM\ManyToOne(targetEntity=Training::class)
     * @ORM\JoinColumn(name="training")
     */
    private $training;
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
        return [Property::class];
    }

    /**
     * @param Property $node
     */
    public function refactor(Node $node): ?Node
    {
        $this->refactorPropertyAnnotations($node);
        return $node;
    }

    private function refactorPropertyAnnotations(Property $property): void
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);

        $this->refactorAnnotation($phpDocInfo, 'Doctrine\ORM\Mapping\Column', 'nullable', false);
        $this->refactorAnnotation($phpDocInfo, 'Doctrine\ORM\Mapping\Column', 'unique', false);
        $this->refactorAnnotation($phpDocInfo, 'Doctrine\ORM\Mapping\Column', 'precision', 0);
        $this->refactorAnnotation($phpDocInfo, 'Doctrine\ORM\Mapping\Column', 'scale', 0);
        $this->refactorAnnotation($phpDocInfo, 'Doctrine\ORM\Mapping\GeneratedValue', 'strategy', 'AUTO');

        $this->refactorAnnotation($phpDocInfo, 'Doctrine\ORM\Mapping\JoinColumn', 'unique', false);
        $this->refactorAnnotation($phpDocInfo, 'Doctrine\ORM\Mapping\JoinColumn', 'nullable', true);
        $this->refactorAnnotation($phpDocInfo, 'Doctrine\ORM\Mapping\JoinColumn', 'referencedColumnName', 'id');

        $this->refactorAnnotation($phpDocInfo, 'Doctrine\ORM\Mapping\ManyToMany', self::ORPHAN_REMOVAL, false);
        $this->refactorAnnotation($phpDocInfo, 'Doctrine\ORM\Mapping\ManyToMany', self::FETCH, self::LAZY);

        $this->refactorAnnotation($phpDocInfo, 'Doctrine\ORM\Mapping\ManyToOne', self::FETCH, self::LAZY);
        $this->refactorAnnotation($phpDocInfo, 'Doctrine\ORM\Mapping\OneToMany', self::ORPHAN_REMOVAL, false);
        $this->refactorAnnotation($phpDocInfo, 'Doctrine\ORM\Mapping\OneToMany', self::FETCH, self::LAZY);
        $this->refactorAnnotation($phpDocInfo, 'Doctrine\ORM\Mapping\OneToOne', self::ORPHAN_REMOVAL, false);
        $this->refactorAnnotation($phpDocInfo, 'Doctrine\ORM\Mapping\OneToOne', self::FETCH, self::LAZY);
    }

    /**
     * @param class-string $annotationClass
     */
    private function refactorAnnotation(
        PhpDocInfo $phpDocInfo,
        string $annotationClass,
        string $argName,
        string|bool|int $defaultValue
    ): void {
        $doctrineAnnotationTagValueNode = $phpDocInfo->getByAnnotationClass($annotationClass);
        if (! $doctrineAnnotationTagValueNode instanceof DoctrineAnnotationTagValueNode) {
            return;
        }

        $this->doctrineItemDefaultValueManipulator->remove(
            $phpDocInfo,
            $doctrineAnnotationTagValueNode,
            $argName,
            $defaultValue
        );
    }
}
