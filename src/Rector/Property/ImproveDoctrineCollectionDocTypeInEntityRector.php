<?php

declare(strict_types=1);

namespace Rector\Doctrine\Rector\Property;

use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Stmt\ClassLike;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Property;
use PHPStan\PhpDocParser\Ast\PhpDoc\VarTagValueNode;
use PHPStan\Reflection\Php\PhpPropertyReflection;
use PHPStan\Type\Type;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\BetterPhpDocParser\PhpDocManipulator\PhpDocTypeChanger;
use Rector\Core\NodeManipulator\AssignManipulator;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\Reflection\ReflectionResolver;
use Rector\Doctrine\NodeAnalyzer\AttributeFinder;
use Rector\Doctrine\NodeAnalyzer\TargetEntityResolver;
use Rector\Doctrine\PhpDocParser\DoctrineDocBlockResolver;
use Rector\Doctrine\TypeAnalyzer\CollectionTypeFactory;
use Rector\Doctrine\TypeAnalyzer\CollectionTypeResolver;
use Rector\Doctrine\TypeAnalyzer\CollectionVarTagValueNodeResolver;
use Rector\StaticTypeMapper\ValueObject\Type\FullyQualifiedObjectType;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Doctrine\Tests\Rector\Property\ImproveDoctrineCollectionDocTypeInEntityRector\ImproveDoctrineCollectionDocTypeInEntityRectorTest
 */
final class ImproveDoctrineCollectionDocTypeInEntityRector extends AbstractRector
{
    public function __construct(
        private readonly CollectionTypeFactory $collectionTypeFactory,
        private readonly AssignManipulator $assignManipulator,
        private readonly CollectionTypeResolver $collectionTypeResolver,
        private readonly CollectionVarTagValueNodeResolver $collectionVarTagValueNodeResolver,
        private readonly PhpDocTypeChanger $phpDocTypeChanger,
        private readonly DoctrineDocBlockResolver $doctrineDocBlockResolver,
        private readonly ReflectionResolver $reflectionResolver,
        private readonly AttributeFinder $attributeFinder,
        private readonly TargetEntityResolver $targetEntityResolver,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Improve @var, @param and @return types for Doctrine collections to make them useful both for PHPStan and PHPStorm',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class SomeClass
{
    /**
     * @ORM\OneToMany(targetEntity=Trainer::class, mappedBy="trainer")
     * @var Collection|Trainer[]
     */
    private $trainings = [];
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class SomeClass
{
    /**
     * @ORM\OneToMany(targetEntity=Trainer::class, mappedBy="trainer")
     * @var Collection<int, Trainer>|Trainer[]
     */
    private $trainings = [];
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
        return [Property::class, ClassMethod::class];
    }

    /**
     * @param Property|ClassMethod $node
     */
    public function refactor(Node $node): ?Node
    {
        if ($node instanceof Property) {
            return $this->refactorProperty($node);
        }

        return $this->refactorClassMethod($node);
    }

    private function refactorProperty(Property $property): ?Property
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);
        if ($phpDocInfo->hasByAnnotationClass('Doctrine\ORM\Mapping\OneToMany')) {
            return $this->refactorPropertyPhpDocInfo($property, $phpDocInfo);
        }

        $targetEntityExpr = $this->attributeFinder->findAttributeByClassArgByName(
            $property,
            'Doctrine\ORM\Mapping\OneToMany',
            'targetEntity'
        );
        if (! $targetEntityExpr instanceof Expr) {
            return null;
        }

        return $this->refactorAttribute($targetEntityExpr, $phpDocInfo, $property);
    }

    private function refactorClassMethod(ClassMethod $classMethod): ?ClassMethod
    {
        if (! $this->doctrineDocBlockResolver->isInDoctrineEntityClass($classMethod)) {
            return null;
        }

        if (! $classMethod->isPublic()) {
            return null;
        }

        $collectionObjectType = $this->resolveCollectionSetterAssignType($classMethod);
        if (! $collectionObjectType instanceof Type) {
            return null;
        }

        if (count($classMethod->params) !== 1) {
            return null;
        }

        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($classMethod);

        $param = $classMethod->params[0];

        if ($param->type instanceof Node) {
            return null;
        }

        /** @var string $parameterName */
        $parameterName = $this->getName($param);

        $this->phpDocTypeChanger->changeParamType($phpDocInfo, $collectionObjectType, $param, $parameterName);

        return $classMethod;
    }

    private function resolveCollectionSetterAssignType(ClassMethod $classMethod): ?Type
    {
        $propertyFetches = $this->assignManipulator->resolveAssignsToLocalPropertyFetches($classMethod);
        if (count($propertyFetches) !== 1) {
            return null;
        }

        $phpPropertyReflection = $this->reflectionResolver->resolvePropertyReflectionFromPropertyFetch(
            $propertyFetches[0]
        );
        if (! $phpPropertyReflection instanceof PhpPropertyReflection) {
            return null;
        }

        $classLike = $this->betterNodeFinder->findParentType($classMethod, ClassLike::class);
        if (! $classLike instanceof ClassLike) {
            return null;
        }

        $propertyName = (string) $this->nodeNameResolver->getName($propertyFetches[0]);
        $property = $classLike->getProperty($propertyName);

        if (! $property instanceof Property) {
            return null;
        }

        $varTagValueNode = $this->collectionVarTagValueNodeResolver->resolve($property);
        if (! $varTagValueNode instanceof VarTagValueNode) {
            return null;
        }

        return $this->staticTypeMapper->mapPHPStanPhpDocTypeNodeToPHPStanType($varTagValueNode->type, $property);
    }

    private function refactorPropertyPhpDocInfo(Property $property, PhpDocInfo $phpDocInfo): ?Property
    {
        $varTagValueNode = $this->collectionVarTagValueNodeResolver->resolve($property);
        if ($varTagValueNode !== null) {
            $collectionObjectType = $this->collectionTypeResolver->resolveFromTypeNode(
                $varTagValueNode->type,
                $property
            );

            if (! $collectionObjectType instanceof FullyQualifiedObjectType) {
                return null;
            }

            $newVarType = $this->collectionTypeFactory->createType($collectionObjectType);
            $this->phpDocTypeChanger->changeVarType($phpDocInfo, $newVarType);
        } else {
            $collectionObjectType = $this->collectionTypeResolver->resolveFromOneToManyProperty($property);
            if (! $collectionObjectType instanceof FullyQualifiedObjectType) {
                return null;
            }

            $newVarType = $this->collectionTypeFactory->createType($collectionObjectType);
            $this->phpDocTypeChanger->changeVarType($phpDocInfo, $newVarType);
        }

        return $property;
    }

    private function refactorAttribute(Expr $targetEntity, PhpDocInfo $phpDocInfo, Property $property): ?Property
    {
        $targetEntityClassName = $this->targetEntityResolver->resolveFromExpr($targetEntity);
        if ($targetEntityClassName === null) {
            return null;
        }

        $collectionObjectType = new FullyQualifiedObjectType($targetEntityClassName);

        $newVarType = $this->collectionTypeFactory->createType($collectionObjectType);
        $this->phpDocTypeChanger->changeVarType($phpDocInfo, $newVarType);

        return $property;
    }
}
