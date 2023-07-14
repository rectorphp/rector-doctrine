<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\Rector\Property;

use PhpParser\Node;
use PhpParser\Node\Stmt\Property;
use PHPStan\Type\MixedType;
use PHPStan\Type\Type;
use PHPStan\Type\TypeCombinator;
use PHPStan\Type\UnionType;
use Rector\Core\Contract\Rector\AllowEmptyConfigurableRectorInterface;
use Rector\Core\Rector\AbstractRector;
use Rector\Core\ValueObject\PhpVersionFeature;
use Rector\Doctrine\NodeManipulator\ColumnPropertyTypeResolver;
use Rector\Doctrine\NodeManipulator\NullabilityColumnPropertyTypeResolver;
use Rector\PHPStanStaticTypeMapper\Enum\TypeKind;
use Rector\TypeDeclaration\NodeTypeAnalyzer\PropertyTypeDecorator;
use Rector\VersionBonding\Contract\MinPhpVersionInterface;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\ConfiguredCodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;
use Webmozart\Assert\Assert;

/**
 * @see \Rector\Doctrine\Tests\CodeQuality\Rector\Property\TypedPropertyFromColumnTypeRector\TypedPropertyFromColumnTypeRectorTest
 */
final class TypedPropertyFromColumnTypeRector extends AbstractRector implements MinPhpVersionInterface, AllowEmptyConfigurableRectorInterface
{
    public const DEFAULT_NULLABLE_COLUMN = 'default_nullable_column';

    private bool $defaultNullableColumn = true;

    public function __construct(
        private readonly PropertyTypeDecorator $propertyTypeDecorator,
        private readonly ColumnPropertyTypeResolver $columnPropertyTypeResolver,
        private readonly NullabilityColumnPropertyTypeResolver $nullabilityColumnPropertyTypeResolver,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition('Complete @var annotations or types based on @ORM\Column', [
            new ConfiguredCodeSample(
                <<<'CODE_SAMPLE'
use Doctrine\ORM\Mapping as ORM;

class SimpleColumn
{
    /**
     * @ORM\Column(type="string")
     */
    private $name;
}
CODE_SAMPLE
                ,
                <<<'CODE_SAMPLE'
use Doctrine\ORM\Mapping as ORM;

class SimpleColumn
{
    /**
     * @ORM\Column(type="string")
     */
    private string|null $name = null;
}
CODE_SAMPLE
				,
				[
					self::DEFAULT_NULLABLE_COLUMN => true,
				]
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

        $isNullable = $this->nullabilityColumnPropertyTypeResolver->isNullable($node, $this->defaultNullableColumn);

        $propertyType = $this->columnPropertyTypeResolver->resolve($node, $isNullable);
        if (! $propertyType instanceof Type || $propertyType instanceof MixedType) {
            return null;
        }

        // add default null if missing
        if ($isNullable && ! TypeCombinator::containsNull($propertyType)) {
            $propertyType = TypeCombinator::addNull($propertyType);
        }

        $typeNode = $this->staticTypeMapper->mapPHPStanTypeToPhpParserNode($propertyType, TypeKind::PROPERTY);
        if ($typeNode === null) {
            return null;
        }

        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($node);

        if ($propertyType instanceof UnionType) {
            $this->propertyTypeDecorator->decoratePropertyUnionType(
                $propertyType,
                $typeNode,
                $node,
                $phpDocInfo
            );
            return $node;
        }

        $node->type = $typeNode;
        return $node;
    }


    public function configure(array $configuration): void
    {
        $defaultNullableColumn = $configuration[self::DEFAULT_NULLABLE_COLUMN] ?? (bool) current($configuration);
        Assert::boolean($defaultNullableColumn);

        $this->defaultNullableColumn = $defaultNullableColumn;
    }

    public function provideMinPhpVersion(): int
    {
        return PhpVersionFeature::TYPED_PROPERTIES;
    }
}
