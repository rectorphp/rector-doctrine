<?php

declare(strict_types=1);

namespace Rector\Doctrine\Rector\Property;

use PhpParser\Node;
use PhpParser\Node\ComplexType;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Property;
use PHPStan\Type\MixedType;
use PHPStan\Type\Type;
use PHPStan\Type\UnionType;
use Rector\BetterPhpDocParser\PhpDocManipulator\PhpDocTypeChanger;
use Rector\Core\Php\PhpVersionProvider;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Core\ValueObject\PhpVersionFeature;
use Rector\Doctrine\NodeManipulator\ToOneRelationPropertyTypeResolver;
use Rector\PHPStanStaticTypeMapper\Enum\TypeKind;
use Rector\TypeDeclaration\NodeTypeAnalyzer\PropertyTypeDecorator;
use Rector\VersionBonding\Contract\MinPhpVersionInterface;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Doctrine\Tests\Rector\Property\TypedPropertyFromToOneRelationTypeRector\TypedPropertyFromToOneRelationTypeRectorTest
 */
final class TypedPropertyFromToOneRelationTypeRector extends AbstractRector implements MinPhpVersionInterface
{
    public function __construct(
        private readonly PropertyTypeDecorator $propertyTypeDecorator,
        private readonly PhpDocTypeChanger $phpDocTypeChanger,
        private readonly ToOneRelationPropertyTypeResolver $toOneRelationPropertyTypeResolver,
        private readonly PhpVersionProvider $phpVersionProvider,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Complete @var annotations or types based on @ORM\*toOne annotations or attributes', [
            new CodeSample(
                <<<'CODE_SAMPLE'
use Doctrine\ORM\Mapping as ORM;

class SimpleColumn
{
    /**
     * @ORM\OneToOne(targetEntity="App\Company\Entity\Company")
     */
    private $company;
}
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
use Doctrine\ORM\Mapping as ORM;

class SimpleColumn
{
    /**
     * @ORM\OneToOne(targetEntity="App\Company\Entity\Company")
     */
    private ?\App\Company\Entity\Company $company = null;
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
        return [Property::class];
    }

    /**
     * @param Property $node
     */
    public function refactor(Node $node): Property|null
    {
        if ($node->type !== null) {
            return null;
        }

        $propertyType = $this->toOneRelationPropertyTypeResolver->resolve($node);
        if (! $propertyType instanceof Type) {
            return null;
        }

        if ($propertyType instanceof MixedType) {
            return null;
        }

        $typeNode = $this->staticTypeMapper->mapPHPStanTypeToPhpParserNode($propertyType, TypeKind::PROPERTY);
        if ($typeNode === null) {
            return null;
        }

        $this->completePropertyTypeOrVarDoc($propertyType, $typeNode, $node);
        return $node;
    }

    public function provideMinPhpVersion(): int
    {
        return PhpVersionFeature::TYPED_PROPERTIES;
    }

    private function completePropertyTypeOrVarDoc(
        Type $propertyType,
        Name|ComplexType|Identifier $typeNode,
        Property $property,
    ): void {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);

        if ($this->phpVersionProvider->isAtLeastPhpVersion(PhpVersion::PHP_74)) {
            if ($propertyType instanceof UnionType) {
                $this->propertyTypeDecorator->decoratePropertyUnionType(
                    $propertyType,
                    $typeNode,
                    $property,
                    $phpDocInfo
                );
                return;
            }

            $property->type = $typeNode;
            return;
        }

        $this->phpDocTypeChanger->changeVarType($property, $phpDocInfo, $propertyType);
    }
}
