<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeManipulator;

use PhpParser\Node\Expr;
use PhpParser\Node\Stmt\Property;
use PHPStan\PhpDocParser\Ast\ConstExpr\ConstExprTrueNode;
use Rector\BetterPhpDocParser\PhpDoc\ArrayItemNode;
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
        private readonly AttributeFinder $attributeFinder,
        private readonly ValueResolver $valueResolver,
    ) {
    }

    public function isNullable(Property $property, bool $defaultNullableColumn): bool
    {
        $nullableExpr = $this->attributeFinder->findAttributeByClassArgByName(
            $property,
            self::COLUMN_CLASS,
            'nullable'
        );

        if ($nullableExpr instanceof Expr) {
            return $this->valueResolver->isTrue($nullableExpr);
        }

        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);
        return $this->isNullableColumn($phpDocInfo, $defaultNullableColumn);
    }

    private function isNullableColumn(PhpDocInfo $phpDocInfo, bool $defaultNullableColumn): bool
    {
        $doctrineAnnotationTagValueNode = $phpDocInfo->findOneByAnnotationClass(self::COLUMN_CLASS);
        if (! $doctrineAnnotationTagValueNode instanceof DoctrineAnnotationTagValueNode) {
            return $defaultNullableColumn;
        }

        $nullableValueArrayItemNode = $doctrineAnnotationTagValueNode->getValue('nullable');
        if (! $nullableValueArrayItemNode instanceof ArrayItemNode) {
            return $defaultNullableColumn;
        }

        return $nullableValueArrayItemNode->value instanceof ConstExprTrueNode;
    }
}
