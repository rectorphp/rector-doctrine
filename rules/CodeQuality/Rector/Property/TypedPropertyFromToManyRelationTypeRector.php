<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\Rector\Property;

use PhpParser\Node;
use PhpParser\Node\Expr\ConstFetch;
use PhpParser\Node\Stmt\Class_;
use PHPStan\Type\MixedType;
use PHPStan\Type\Type;
use PHPStan\Type\TypeCombinator;
use PHPStan\Type\UnionType;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\BetterPhpDocParser\PhpDocManipulator\PhpDocTypeChanger;
use Rector\Doctrine\NodeManipulator\ToManyRelationPropertyTypeResolver;
use Rector\Php\PhpVersionProvider;
use Rector\PhpParser\Node\Value\ValueResolver;
use Rector\PHPStanStaticTypeMapper\Enum\TypeKind;
use Rector\Rector\AbstractRector;
use Rector\StaticTypeMapper\StaticTypeMapper;
use Rector\TypeDeclaration\AlreadyAssignDetector\ConstructorAssignDetector;
use Rector\TypeDeclaration\NodeTypeAnalyzer\PropertyTypeDecorator;
use Rector\ValueObject\PhpVersion;
use Rector\ValueObject\PhpVersionFeature;
use Rector\VersionBonding\Contract\MinPhpVersionInterface;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromToManyRelationTypeRector\TypedPropertyFromToManyRelationTypeRectorTest
 */
final class TypedPropertyFromToManyRelationTypeRector extends AbstractRector implements MinPhpVersionInterface
{
    public function __construct(
        private readonly PropertyTypeDecorator $propertyTypeDecorator,
        private readonly PhpDocTypeChanger $phpDocTypeChanger,
        private readonly ToManyRelationPropertyTypeResolver $toManyRelationPropertyTypeResolver,
        private readonly PhpVersionProvider $phpVersionProvider,
        private readonly PhpDocInfoFactory $phpDocInfoFactory,
        private readonly StaticTypeMapper $staticTypeMapper,
        private readonly ConstructorAssignDetector $constructorAssignDetector,
        private readonly ValueResolver $valueResolver
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Complete Collection @var annotations and property type declarations, based on @ORM\*toMany and @ODM\*toMany annotations or attributes',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Doctrine\ORM\Mapping as ORM;

class SimpleColumn
{
    /**
     * @ORM\OneToMany(targetEntity="App\Product")
     */
    private $products;
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

class SimpleColumn
{
    /**
     * @ORM\OneToMany(targetEntity="App\Product")
     * @var Collection<int, \App\Product>
     */
    private Collection $products;
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
    public function refactor(Node $node): Class_|null
    {
        $properties = $node->getProperties();

        $hasChanged = false;
        foreach ($properties as $property) {
            if ($property->type !== null) {
                continue;
            }

            $propertyType = $this->toManyRelationPropertyTypeResolver->resolve($property);
            if (! $propertyType instanceof Type || $propertyType instanceof MixedType) {
                continue;
            }

            $typeNode = $this->staticTypeMapper->mapPHPStanTypeToPhpParserNode($propertyType, TypeKind::PROPERTY);
            if (! $typeNode instanceof Node) {
                continue;
            }

            $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);

            // always decorate with collection generic type
            $this->phpDocTypeChanger->changeVarType($property, $phpDocInfo, $propertyType);

            $isAssignedInConstructor = $this->constructorAssignDetector->isPropertyAssigned(
                $node,
                (string) $this->getName($property)
            );

            // remove default null value if any
            if ($property->props[0]->default !== null && $isAssignedInConstructor) {
                $property->props[0]->default = null;
            }

            if ($this->phpVersionProvider->isAtLeastPhpVersion(PhpVersion::PHP_74)) {
                if ($propertyType instanceof UnionType) {
                    $this->propertyTypeDecorator->decoratePropertyUnionType(
                        $propertyType,
                        $typeNode,
                        $property,
                        $phpDocInfo
                    );
                } else {
                    $property->type = $typeNode;
                }

                if (! $isAssignedInConstructor && $property->props[0]->default instanceof ConstFetch && $this->valueResolver->isNull(
                    $property->props[0]->default
                )) {
                    // this should make nullable
                    $type = TypeCombinator::addNull($propertyType);
                    $propertyType = $this->staticTypeMapper->mapPHPStanTypeToPhpParserNode($type, TypeKind::PROPERTY);

                    if ($propertyType instanceof Node) {
                        $property->type = $propertyType;
                    }
                }

                $hasChanged = true;
            }
        }

        if (! $hasChanged) {
            return null;
        }

        return $node;
    }

    public function provideMinPhpVersion(): int
    {
        return PhpVersionFeature::TYPED_PROPERTIES;
    }
}
