<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeManipulator;

use PhpParser\Node\Attribute;
use PhpParser\Node\Expr;
use PhpParser\Node\Stmt\Property;
use PHPStan\PhpDocParser\Ast\ConstExpr\ConstExprTrueNode;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Core\PhpParser\Node\Value\ValueResolver;
use Rector\Doctrine\NodeAnalyzer\AttributeFinder;

final class NullabilityColumnPropertyTypeResolver
{
    /**
     * @var string
     */
    private const COLUMN_CLASS = 'Doctrine\ORM\Mapping\Column';

    /**
     * @see https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/basic-mapping.html#doctrine-mapping-types
     */
    public function __construct(
        private readonly PhpDocInfoFactory $phpDocInfoFactory,
        private AttributeFinder $attributeFinder,
        private ValueResolver $valueResolver,
    ) {
    }

    public function isNullable(Property $property): bool
    {
        $columnAttribute = $this->attributeFinder->findAttributeByClass($property, self::COLUMN_CLASS);

        if ($columnAttribute instanceof Attribute) {
            $nullableExpr = $this->attributeFinder->findArgByName($columnAttribute, 'nullable');
            if (! $nullableExpr instanceof Expr) {
                return true;
            }

            return $this->valueResolver->isTrue($nullableExpr);
        }

        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);
        return $this->isNullableColumn($phpDocInfo);
    }

    private function isNullableColumn(PhpDocInfo $phpDocInfo): bool
    {
        $doctrineAnnotationTagValueNode = $phpDocInfo->findOneByAnnotationClass(self::COLUMN_CLASS);
        if (! $doctrineAnnotationTagValueNode instanceof DoctrineAnnotationTagValueNode) {
            return true;
        }

        $nullableValue = $doctrineAnnotationTagValueNode->getValue('nullable');
        return $nullableValue === null || $nullableValue instanceof ConstExprTrueNode;
    }
}
