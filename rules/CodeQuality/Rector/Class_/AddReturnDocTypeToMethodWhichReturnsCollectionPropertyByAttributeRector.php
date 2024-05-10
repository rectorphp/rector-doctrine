<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\Rector\Class_;

use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Property;
use PhpParser\Node\Stmt\Return_;
use PHPStan\Analyser\Scope;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\BetterPhpDocParser\PhpDocManipulator\PhpDocTypeChanger;
use Rector\Doctrine\CodeQuality\Enum\ToManyMappings;
use Rector\Doctrine\NodeAnalyzer\AttributeFinder;
use Rector\Doctrine\NodeAnalyzer\TargetEntityResolver;
use Rector\Doctrine\TypeAnalyzer\CollectionTypeFactory;
use Rector\PhpParser\Node\BetterNodeFinder;
use Rector\Rector\AbstractScopeAwareRector;
use Rector\StaticTypeMapper\ValueObject\Type\FullyQualifiedObjectType;
use Rector\ValueObject\PhpVersionFeature;
use Rector\VendorLocker\NodeVendorLocker\ClassMethodReturnTypeOverrideGuard;
use Rector\VersionBonding\Contract\MinPhpVersionInterface;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 *  @see \Rector\Doctrine\Tests\CodeQuality\Rector\Class_\AddReturnDocTypeToMethodWhichReturnsCollectionPropertyByAttributeRector\AddReturnDocTypeToMethodWhichReturnsCollectionPropertyByAttributeRectorTest
 */
final class AddReturnDocTypeToMethodWhichReturnsCollectionPropertyByAttributeRector extends AbstractScopeAwareRector implements MinPhpVersionInterface
{
    public function __construct(
        private readonly ClassMethodReturnTypeOverrideGuard $classMethodReturnTypeOverrideGuard,
        private readonly BetterNodeFinder $betterNodeFinder,
        private readonly PhpDocInfoFactory $phpDocInfoFactory,
        private readonly PhpDocTypeChanger $phpDocTypeChanger,
        private readonly AttributeFinder $attributeFinder,
        private readonly TargetEntityResolver $targetEntityResolver,
        private readonly CollectionTypeFactory $collectionTypeFactory
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Add re11111turn method return type based on strict typed property', [new CodeSample(
            <<<'CODE_SAMPLE'
final class SomeClass
{
    private int $age = 100;

    public function getAge()
    {
        return $this->age;
    }
}
CODE_SAMPLE
            ,
            <<<'CODE_SAMPLE'
final class SomeClass
{
    private int $age = 100;

    public function getAge(): int
    {
        return $this->age;
    }
}
CODE_SAMPLE
        )]);
    }

    /**
     * @return array<class-string<Node>>
     */
    public function getNodeTypes(): array
    {
        return [Class_::class];
    }

    /**
     * @param Class_ $class
     */
    public function refactorWithScope(Node $class, Scope $scope): ?Node
    {
        if (! $this->isDoctrineEntityClass($class)) {
            return null;
        }

        foreach ($class->getMethods() as $classMethod) {
            if ($this->classMethodReturnTypeOverrideGuard->shouldSkipClassMethod($classMethod, $scope)) {
                return null;
            }

            $property = $this->resolveReturnProperty($class, $classMethod);

            if ($property === null) {
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

        return $class;
    }

    public function provideMinPhpVersion(): int
    {
        return PhpVersionFeature::ATTRIBUTES;
    }

    private function resolveReturnProperty(Class_ $class, ClassMethod $classMethod): ?Property
    {
        /** @var Return_[] $returns */
        $returns = $this->betterNodeFinder->findInstancesOfInFunctionLikeScoped($classMethod, Return_::class);

        $return = reset($returns);

        if (! $return instanceof Return_) {
            return null;
        }

        $returnExpr = $return->expr;

        if (! $returnExpr instanceof Expr) {
            return null;
        }

        if (! $returnExpr instanceof PropertyFetch) {
            return null;
        }

        $propertyName = (string) $this->nodeNameResolver->getName($returnExpr);

        return $class->getProperty($propertyName);
    }

    private function getCollectionObjectTypeFromToManyAttribute(Property $property): ?FullyQualifiedObjectType
    {
        $targetEntityExpr = $this->attributeFinder->findAttributeByClassesArgByName(
            $property,
            ToManyMappings::TO_MANY_CLASSES,
            'targetEntity'
        );

        if (! $targetEntityExpr instanceof Expr\ClassConstFetch) {
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

        return $entityAttribute !== null;
    }
}
