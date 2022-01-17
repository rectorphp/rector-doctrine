<?php

declare(strict_types=1);

namespace Rector\Doctrine\Rector\Property;

use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Stmt\Property;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\Core\Rector\AbstractRector;
use Rector\Doctrine\NodeAnalyzer\AttributeFinder;
use Rector\Doctrine\NodeManipulator\DoctrineItemDefaultValueManipulator;
use Rector\Doctrine\ValueObject\ArgName;
use Rector\Doctrine\ValueObject\DefaultAnnotationArgValue;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Doctrine\Tests\Rector\Property\RemoveRedundantDefaultPropertyAnnotationValuesRector\RemoveRedundantDefaultPropertyAnnotationValuesRectorTest
 *
 * @changelog https://www.doctrine-project.org/projects/doctrine-orm/en/2.8/reference/basic-mapping.html#property-mapping
 */
final class RemoveRedundantDefaultPropertyAnnotationValuesRector extends AbstractRector
{
    /**
     * @var DefaultAnnotationArgValue[]
     */
    private array $defaultAnnotationArgValues = [];

    public function __construct(
        private DoctrineItemDefaultValueManipulator $doctrineItemDefaultValueManipulator,
        private AttributeFinder $attributeFinder,
    ) {
        $this->defaultAnnotationArgValues = [
            new DefaultAnnotationArgValue('Doctrine\ORM\Mapping\Column', 'nullable', false),
            new DefaultAnnotationArgValue('Doctrine\ORM\Mapping\Column', 'unique', false),
            new DefaultAnnotationArgValue('Doctrine\ORM\Mapping\Column', 'precision', 0),
            new DefaultAnnotationArgValue('Doctrine\ORM\Mapping\Column', 'scale', 0),
            new DefaultAnnotationArgValue('Doctrine\ORM\Mapping\GeneratedValue', 'strategy', 'AUTO'),
            new DefaultAnnotationArgValue('Doctrine\ORM\Mapping\JoinColumn', 'unique', false),
            new DefaultAnnotationArgValue('Doctrine\ORM\Mapping\JoinColumn', 'nullable', true),
            new DefaultAnnotationArgValue('Doctrine\ORM\Mapping\JoinColumn', 'referencedColumnName', 'id'),
            new DefaultAnnotationArgValue('Doctrine\ORM\Mapping\ManyToMany', ArgName::ORPHAN_REMOVAL, false),
            new DefaultAnnotationArgValue('Doctrine\ORM\Mapping\ManyToMany', ArgName::FETCH, ArgName::LAZY),
            new DefaultAnnotationArgValue('Doctrine\ORM\Mapping\ManyToOne', ArgName::FETCH, ArgName::LAZY),
            new DefaultAnnotationArgValue('Doctrine\ORM\Mapping\OneToMany', ArgName::ORPHAN_REMOVAL, false),
            new DefaultAnnotationArgValue('Doctrine\ORM\Mapping\OneToMany', ArgName::FETCH, ArgName::LAZY),
            new DefaultAnnotationArgValue('Doctrine\ORM\Mapping\OneToOne', ArgName::ORPHAN_REMOVAL, false),
            new DefaultAnnotationArgValue('Doctrine\ORM\Mapping\OneToOne', ArgName::FETCH, ArgName::LAZY),
        ];
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

        foreach ($this->defaultAnnotationArgValues as $defaultAnnotationArgValue) {
            $argExpr = $this->attributeFinder->findAttributeByClassArgByName(
                $node,
                $defaultAnnotationArgValue->getAnnotationClass(),
                $defaultAnnotationArgValue->getArgName()
            );

            if (! $argExpr instanceof Expr) {
                continue;
            }

            dump_with_depth($argExpr);
            die;
        }

        return $node;
    }

    private function refactorPropertyAnnotations(Property $property): void
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNode($property);

        if ($phpDocInfo instanceof PhpDocInfo) {
            foreach ($this->defaultAnnotationArgValues as $defaultAnnotationArgValue) {
                $this->refactorAnnotation(
                    $phpDocInfo,
                    $defaultAnnotationArgValue->getAnnotationClass(),
                    $defaultAnnotationArgValue->getArgName(),
                    $defaultAnnotationArgValue->getDefaultValue()
                );
            }
        }
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
