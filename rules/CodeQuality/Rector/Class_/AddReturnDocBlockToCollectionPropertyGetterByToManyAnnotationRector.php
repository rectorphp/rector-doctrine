<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;
use PHPStan\Analyser\Scope;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\BetterPhpDocParser\PhpDocManipulator\PhpDocTypeChanger;
use Rector\Doctrine\NodeAnalyzer\MethodUniqueReturnedPropertyResolver;
use Rector\Doctrine\PhpDocParser\DoctrineDocBlockResolver;
use Rector\Doctrine\TypeAnalyzer\CollectionTypeFactory;
use Rector\Doctrine\TypeAnalyzer\CollectionTypeResolver;
use Rector\Rector\AbstractScopeAwareRector;
use Rector\StaticTypeMapper\ValueObject\Type\FullyQualifiedObjectType;
use Rector\VendorLocker\NodeVendorLocker\ClassMethodReturnTypeOverrideGuard;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 *  @see \Rector\Doctrine\Tests\CodeQuality\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector\AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRectorTest
 */
final class AddReturnDocBlockToCollectionPropertyGetterByToManyAnnotationRector extends AbstractScopeAwareRector
{
    public function __construct(
        private readonly ClassMethodReturnTypeOverrideGuard $classMethodReturnTypeOverrideGuard,
        private readonly PhpDocInfoFactory $phpDocInfoFactory,
        private readonly DoctrineDocBlockResolver $doctrineDocBlockResolver,
        private readonly PhpDocTypeChanger $phpDocTypeChanger,
        private readonly CollectionTypeResolver $collectionTypeResolver,
        private readonly CollectionTypeFactory $collectionTypeFactory,
        private readonly MethodUniqueReturnedPropertyResolver $methodUniqueReturnedPropertyResolver,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Adds @return PHPDoc type to Collection property getter by *ToMany annotation/attribute',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use App\Entity\Training;

/**
 * @ORM\Entity
 */
final class Trainer
{
    /**
     * @ORM\OneToMany(targetEntity=Training::class)
     */
    private $trainings;

    public function getTrainings()
    {
        return $this->trainings;
    }
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
/**
 * @ORM\Entity
 */
final class Trainer
{
    /**
     * @ORM\OneToMany(targetEntity=Training::class)
     */
    private $trainings;

    /**
     * @return \Doctrine\Common\Collections\Collection<int, \App\Entity\Training>
     */
    public function getTrainings()
    {
        return $this->trainings;
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
    public function refactorWithScope(Node $node, Scope $scope): ?Node
    {
        if (! $this->doctrineDocBlockResolver->isDoctrineEntityClass($node)) {
            return null;
        }

        $hasChanged = false;

        foreach ($node->getMethods() as $classMethod) {
            if ($this->classMethodReturnTypeOverrideGuard->shouldSkipClassMethod($classMethod, $scope)) {
                continue;
            }

            $property = $this->methodUniqueReturnedPropertyResolver->resolve($node, $classMethod);
            if (! $property instanceof Property) {
                continue;
            }

            $collectionObjectType = $this->collectionTypeResolver->resolveFromToManyProperty($property);
            if (! $collectionObjectType instanceof FullyQualifiedObjectType) {
                continue;
            }

            // update docblock with known collection type
            $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($classMethod);
            $newVarType = $this->collectionTypeFactory->createType($collectionObjectType);
            $this->phpDocTypeChanger->changeReturnType($classMethod, $phpDocInfo, $newVarType);
            $hasChanged = true;
        }

        return $hasChanged ? $node : null;
    }
}
