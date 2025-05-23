<?php

declare(strict_types=1);

namespace Rector\Doctrine\TypedCollections\Rector\Property;

use PhpParser\Node;
use PhpParser\Node\Stmt\Property;
use PHPStan\Type\MixedType;
use PHPStan\Type\Type;
use PHPStan\Type\UnionType;
use Rector\Doctrine\Enum\DoctrineClass;
use Rector\Doctrine\NodeManipulator\ToManyRelationPropertyTypeResolver;
use Rector\PHPStanStaticTypeMapper\Enum\TypeKind;
use Rector\Rector\AbstractRector;
use Rector\StaticTypeMapper\StaticTypeMapper;
use Rector\ValueObject\PhpVersionFeature;
use Rector\VersionBonding\Contract\MinPhpVersionInterface;
use Symplify\RuleDocGenerator\ValueObject\CodeSample\CodeSample;
use Symplify\RuleDocGenerator\ValueObject\RuleDefinition;

/**
 * @see \Rector\Doctrine\Tests\TypedCollections\Rector\Property\TypedPropertyFromToManyRelationTypeRector\TypedPropertyFromToManyRelationTypeRectorTest
 */
final class TypedPropertyFromToManyRelationTypeRector extends AbstractRector implements MinPhpVersionInterface
{
    public function __construct(
        private readonly ToManyRelationPropertyTypeResolver $toManyRelationPropertyTypeResolver,
        private readonly StaticTypeMapper $staticTypeMapper,
    ) {
    }

    public function getRuleDefinition(): RuleDefinition
    {
        return new RuleDefinition(
            'Add "Doctrine\Common\Collections\Collection" type declaration, based on @ORM\*toMany and @ODM\*toMany annotations/attributes',
            [
                new CodeSample(
                    <<<'CODE_SAMPLE'
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;

class SimpleColumn
{
    /**
     * @ORM\OneToMany(targetEntity="App\Product")
     */
    private $products;

    #[ManyToMany(targetEntity: 'App\Car')]
    private $cars;
}
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\Common\Collections\Collection;

class SimpleColumn
{
    /**
     * @ORM\OneToMany(targetEntity="App\Product")
     */
    private Collection $products;

    #[ManyToMany(targetEntity: 'App\Car')]
    private Collection $cars;
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
    public function refactor(Node $node): ?Property
    {
        if ($node->type !== null && $this->isName($node->type, DoctrineClass::COLLECTION)) {
            return null;
        }

        $propertyType = $this->toManyRelationPropertyTypeResolver->resolve($node);
        if (! $propertyType instanceof Type || $propertyType instanceof MixedType) {
            return null;
        }

        $typeNode = $this->staticTypeMapper->mapPHPStanTypeToPhpParserNode($propertyType, TypeKind::PROPERTY);
        if (! $typeNode instanceof Node) {
            return null;
        }

        // remove default null value if any
        if ($node->props[0]->default !== null) {
            $node->props[0]->default = null;
        }

        if (! $propertyType instanceof UnionType) {
            $node->type = $typeNode;
        }

        return $node;
    }

    public function provideMinPhpVersion(): int
    {
        return PhpVersionFeature::TYPED_PROPERTIES;
    }
}
