<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\Rector\Property;

use Doctrine\ORM\Mapping\Embedded;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OneToOne;
use PhpParser\Node;
use PhpParser\Node\Attribute;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Identifier;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\Property;
use Rector\BetterPhpDocParser\PhpDoc\ArrayItemNode;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDoc\StringNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\Core\Rector\AbstractRector;
use Rector\Doctrine\NodeAnalyzer\AttributeFinder;
use Rector\Doctrine\PhpDocParser\DoctrineClassAnnotationMatcher;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Doctrine\Tests\CodeQuality\Rector\Property\DoctrineTargetEntityStringToClassConstantRector\DoctrineTargetEntityStringToClassConstantRectorTest
 */
final class DoctrineTargetEntityStringToClassConstantRector extends AbstractRector
{
    /**
     * @var string
     */
    private const ATTRIBUTE_NAME__TARGET_ENTITY = 'targetEntity';

    /**
     * @var string
     */
    private const ATTRIBUTE_NAME__CLASS = 'class';

    /**
     * @var array<class-string<OneToMany|ManyToOne|OneToOne|ManyToMany|Embedded>, string>
     */
    private const VALID_DOCTRINE_CLASSES = [
        'Doctrine\ORM\Mapping\OneToMany' => self::ATTRIBUTE_NAME__TARGET_ENTITY,
        'Doctrine\ORM\Mapping\ManyToOne' => self::ATTRIBUTE_NAME__TARGET_ENTITY,
        'Doctrine\ORM\Mapping\OneToOne' => self::ATTRIBUTE_NAME__TARGET_ENTITY,
        'Doctrine\ORM\Mapping\ManyToMany' => self::ATTRIBUTE_NAME__TARGET_ENTITY,
        'Doctrine\ORM\Mapping\Embedded' => self::ATTRIBUTE_NAME__CLASS,
    ];

    public function __construct(
        private readonly DoctrineClassAnnotationMatcher $doctrineClassAnnotationMatcher,
        private readonly AttributeFinder $attributeFinder
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Convert targetEntities defined as String to <class>::class Constants in Doctrine Entities.',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
final class SomeClass
{
    /**
     * @ORM\OneToMany(targetEntity="AnotherClass")
     */
    private readonly ?Collection $items;

    #[ORM\ManyToOne(targetEntity: "AnotherClass")]
    private readonly ?Collection $items2;
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
final class SomeClass
{
    /**
     * @ORM\OneToMany(targetEntity=\MyNamespace\Source\AnotherClass::class)
     */
    private readonly ?Collection $items;

    #[ORM\ManyToOne(targetEntity: \MyNamespace\Source\AnotherClass::class)]
    private readonly ?Collection $items2;
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
        $phpDocInfo = $this->phpDocInfoFactory->createFromNode($node);
        if ($phpDocInfo instanceof PhpDocInfo) {
            $property = $this->changeTypeInAnnotationTypes($node, $phpDocInfo);
            $annotationDetected = $property instanceof Property || $phpDocInfo->hasChanged();

            if ($annotationDetected) {
                return $property;
            }
        }

        return $this->changeTypeInAttributeTypes($node);
    }

    private function changeTypeInAttributeTypes(Property $property): ?Property
    {
        $attribute = $this->attributeFinder->findAttributeByClasses($property, $this->getAttributeClasses());

        if (! $attribute instanceof Attribute) {
            return null;
        }

        return $this->changeTypeInAttribute($attribute, $property);
    }

    private function changeTypeInAttribute(Attribute $attribute, Property $property): ?Property
    {
        $attributeName = $this->getAttributeName($attribute);
        foreach ($attribute->args as $arg) {
            $argName = $arg->name;
            if (! $argName instanceof Identifier) {
                continue;
            }

            if (! $this->isName($argName, $attributeName)) {
                continue;
            }

            if (! $arg->value instanceof String_) {
                continue;
            }

            /** @var string $value - Should always be string at this point */
            $value = $this->valueResolver->getValue($arg->value);
            $fullyQualified = $this->doctrineClassAnnotationMatcher->resolveExpectingDoctrineFQCN($value, $property);

            if ($fullyQualified === $value) {
                continue;
            }

            if ($fullyQualified === null) {
                continue;
            }

            $fullyQualifiedWithoutLeadingBackslash = ltrim($fullyQualified, '\\');
            $arg->value = $this->nodeFactory->createClassConstFetch(
                $fullyQualifiedWithoutLeadingBackslash,
                'class'
            );

            return $property;
        }

        return null;
    }

    private function changeTypeInAnnotationTypes(Property $property, PhpDocInfo $phpDocInfo): ?Property
    {
        $doctrineAnnotationTagValueNode = $phpDocInfo->getByAnnotationClasses($this->getAttributeClasses());

        if (! $doctrineAnnotationTagValueNode instanceof DoctrineAnnotationTagValueNode) {
            return null;
        }

        return $this->processDoctrineToMany($doctrineAnnotationTagValueNode, $property);
    }

    private function processDoctrineToMany(
        DoctrineAnnotationTagValueNode $doctrineAnnotationTagValueNode,
        Property $property
    ): ?Property {
        $key = $doctrineAnnotationTagValueNode->hasClassName(
            'Doctrine\ORM\Mapping\Embedded'
        ) ? self::ATTRIBUTE_NAME__CLASS : self::ATTRIBUTE_NAME__TARGET_ENTITY;

        $targetEntityArrayItemNode = $doctrineAnnotationTagValueNode->getValue($key);
        if (! $targetEntityArrayItemNode instanceof ArrayItemNode) {
            return null;
        }

        $targetEntityClass = $targetEntityArrayItemNode->value;

        if ($targetEntityClass instanceof StringNode) {
            $targetEntityClass = $targetEntityClass->value;
        }

        if (! is_string($targetEntityClass)) {
            return null;
        }

        // resolve to FQN
        $tagFullyQualifiedName = $this->doctrineClassAnnotationMatcher->resolveExpectingDoctrineFQCN(
            $targetEntityClass,
            $property
        );

        if ($tagFullyQualifiedName === null) {
            return null;
        }

        if ($tagFullyQualifiedName === $targetEntityClass) {
            return null;
        }

        $currentArrayItemNode = $doctrineAnnotationTagValueNode->getValue($key);
        if (! $currentArrayItemNode instanceof ArrayItemNode) {
            return null;
        }

        $currentArrayItemNode->value = '\\' . ltrim($tagFullyQualifiedName, '\\') . '::class';
        $currentArrayItemNode->setAttribute('orig_node', null);

        return $property;
    }

    /**
     * @return class-string[]
     */
    private function getAttributeClasses(): array
    {
        return array_keys(self::VALID_DOCTRINE_CLASSES);
    }

    private function getAttributeName(Attribute $attribute): string
    {
        return self::VALID_DOCTRINE_CLASSES[$attribute->name->toString()];
    }
}
