<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\Rector\Property;

use PhpParser\Node;
use PhpParser\Node\ComplexType;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Property;
use PHPStan\Type\MixedType;
use PHPStan\Type\Type;
use PHPStan\Type\UnionType;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\BetterPhpDocParser\PhpDocManipulator\PhpDocTypeChanger;
use Rector\Contract\Rector\ConfigurableRectorInterface;
use Rector\Doctrine\NodeManipulator\ToOneRelationPropertyTypeResolver;
use Rector\Php\PhpVersionProvider;
use Rector\PHPStanStaticTypeMapper\Enum\TypeKind;
use Rector\Rector\AbstractRector;
use Rector\StaticTypeMapper\StaticTypeMapper;
use Rector\TypeDeclaration\NodeTypeAnalyzer\PropertyTypeDecorator;
use Rector\ValueObject\PhpVersion;
use Rector\ValueObject\PhpVersionFeature;
use Rector\VersionBonding\Contract\MinPhpVersionInterface;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use Webmozart\Assert\Assert;

/**
 * @see \Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromToOneRelationTypeRector\TypedPropertyFromToOneRelationTypeRectorTest
 */
final class TypedPropertyFromToOneRelationTypeRector extends AbstractRector implements MinPhpVersionInterface, ConfigurableRectorInterface
{
    public const FORCE_NULLABLE = 'force_nullable';

    private bool $forceNullable = true;

    public function __construct(
        private readonly PropertyTypeDecorator $propertyTypeDecorator,
        private readonly PhpDocTypeChanger $phpDocTypeChanger,
        private readonly ToOneRelationPropertyTypeResolver $toOneRelationPropertyTypeResolver,
        private readonly PhpVersionProvider $phpVersionProvider,
        private readonly PhpDocInfoFactory $phpDocInfoFactory,
        private readonly StaticTypeMapper $staticTypeMapper,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Complete @var annotations or types based on @ORM\*toOne annotations or attributes',
            [
                new ConfiguredCodeSample(
                    <<<'CODE_SAMPLE'
use Doctrine\ORM\Mapping as ORM;

class SimpleColumn
{
    /**
     * @ORM\OneToOne(targetEntity="App\Company\Entity\Company")
     * @ORM\JoinColumn(nullable=false)
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
     * @ORM\JoinColumn(nullable=false)
     */
    private ?\App\Company\Entity\Company $company = null;
}
CODE_SAMPLE
                    ,
                    [
                        'force_nullable' => true,
                    ]
                ),
                new ConfiguredCodeSample(
                    <<<'CODE_SAMPLE'
use Doctrine\ORM\Mapping as ORM;

class SimpleColumn
{
    /**
     * @ORM\OneToOne(targetEntity="App\Company\Entity\Company")
     * @ORM\JoinColumn(nullable=false)
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
     * @ORM\JoinColumn(nullable=false)
     */
    private \App\Company\Entity\Company $company;
}
CODE_SAMPLE
                    ,
                    [
                        'force_nullable' => false,
                    ]
                ),
            ],
        );
    }

    /**
     * @param array<string, bool> $configuration
     */
    public function configure(array $configuration): void
    {
        if (isset($configuration[self::FORCE_NULLABLE])) {
            Assert::boolean($configuration[self::FORCE_NULLABLE]);
            $this->forceNullable = $configuration[self::FORCE_NULLABLE];
        }
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

        $propertyType = $this->toOneRelationPropertyTypeResolver->resolve($node, $this->forceNullable);
        if (! $propertyType instanceof Type) {
            return null;
        }

        if ($propertyType instanceof MixedType) {
            return null;
        }

        $typeNode = $this->staticTypeMapper->mapPHPStanTypeToPhpParserNode($propertyType, TypeKind::PROPERTY);
        if (! $typeNode instanceof Node) {
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
