<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Attribute;
use PhpParser\Node\Expr\ClassConstFetch;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;
use PHPStan\Analyser\Scope;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\BetterPhpDocParser\PhpDocManipulator\PhpDocTypeChanger;
use Rector\Doctrine\CodeQuality\Enum\ToManyMappings;
use Rector\Doctrine\NodeAnalyzer\AttributeFinder;
use Rector\Doctrine\NodeAnalyzer\MethodUniqueReturnedPropertyResolver;
use Rector\Doctrine\NodeAnalyzer\TargetEntityResolver;
use Rector\Doctrine\TypeAnalyzer\CollectionTypeFactory;
use Rector\Rector\AbstractScopeAwareRector;
use Rector\StaticTypeMapper\ValueObject\Type\FullyQualifiedObjectType;
use Rector\ValueObject\PhpVersionFeature;
use Rector\VendorLocker\NodeVendorLocker\ClassMethodReturnTypeOverrideGuard;
use Rector\VersionBonding\Contract\MinPhpVersionInterface;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 *  @see \Rector\Doctrine\Tests\CodeQuality\Rector\Class_\AddReturnDocBlockToCollectionPropertyGetterByToManyAttributeRector\AddReturnDocBlockToCollectionPropertyGetterByToManyAttributeRectorTest
 */
final class AddReturnDocBlockToCollectionPropertyGetterByToManyAttributeRector extends AbstractScopeAwareRector implements MinPhpVersionInterface
{
    public function __construct(
        private readonly ClassMethodReturnTypeOverrideGuard $classMethodReturnTypeOverrideGuard,
        private readonly PhpDocInfoFactory $phpDocInfoFactory,
        private readonly PhpDocTypeChanger $phpDocTypeChanger,
        private readonly AttributeFinder $attributeFinder,
        private readonly TargetEntityResolver $targetEntityResolver,
        private readonly CollectionTypeFactory $collectionTypeFactory,
        private readonly MethodUniqueReturnedPropertyResolver $methodUniqueReturnedPropertyResolver,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Adds @return PHPDoc type to Collection property getter by *ToMany attribute', [
            new CodeSample(
                <<<'CODE_SAMPLE'
#[ORM\Entity]
final class AdderParam
{
    #[ORM\OneToMany(targetEntity:Training::class, mappedBy:"trainer")]
    private $trainings;

    public function getTrainings()
    {
        return $this->trainings;
    }
}
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
#[ORM\Entity]
final class AdderParam
{
    #[ORM\OneToMany(targetEntity:Training::class, mappedBy:"trainer")]
    private $trainings;

    /**
     * @return \Doctrine\Common\Collections\Collection<int, \Rector\Doctrine\Tests\CodeQuality\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\Source\Training>
     */
    public function getTrainings()
    {
        return $this->trainings;
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
    public function refactorWithScope(Node $node, Scope $scope): ?Node
    {
        if (! $this->isDoctrineEntityClass($node)) {
            return null;
        }

        foreach ($node->getMethods() as $classMethod) {
            if ($this->classMethodReturnTypeOverrideGuard->shouldSkipClassMethod($classMethod, $scope)) {
                return null;
            }

            $property = $this->methodUniqueReturnedPropertyResolver->resolve($node, $classMethod);

            if (! $property instanceof Property) {
                continue;
            }

            $collectionObjectType = $this->getCollectionObjectTypeFromToManyAttribute($property);

            if (! $collectionObjectType instanceof FullyQualifiedObjectType) {
                return null;
            }

            $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($classMethod);
            $newVarType = $this->collectionTypeFactory->createType($collectionObjectType);
            $this->phpDocTypeChanger->changeReturnType($classMethod, $phpDocInfo, $newVarType);
        }

        return $node;
    }

    public function provideMinPhpVersion(): int
    {
        return PhpVersionFeature::ATTRIBUTES;
    }

    private function getCollectionObjectTypeFromToManyAttribute(Property $property): ?FullyQualifiedObjectType
    {
        $targetEntityExpr = $this->attributeFinder->findAttributeByClassesArgByName(
            $property,
            ToManyMappings::TO_MANY_CLASSES,
            'targetEntity'
        );

        if (! $targetEntityExpr instanceof ClassConstFetch) {
            return null;
        }

        $targetEntityClassName = $this->targetEntityResolver->resolveFromExpr($targetEntityExpr);

        if ($targetEntityClassName === null) {
            return null;
        }

        return new FullyQualifiedObjectType($targetEntityClassName);
    }

    private function isDoctrineEntityClass(Class_ $class): bool
    {
        $entityAttribute = $this->attributeFinder->findAttributeByClasses(
            $class,
            ['Doctrine\ORM\Mapping\Entity', 'Doctrine\ORM\Mapping\Embeddable'],
        );

        return $entityAttribute instanceof Attribute;
    }
}
