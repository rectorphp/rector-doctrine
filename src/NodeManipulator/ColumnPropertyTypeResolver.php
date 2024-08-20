<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeManipulator;

use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\Property;
use PHPStan\Type\BooleanType;
use PHPStan\Type\FloatType;
use PHPStan\Type\IntegerType;
use PHPStan\Type\MixedType;
use PHPStan\Type\NullType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\StringType;
use PHPStan\Type\Type;
use Rector\BetterPhpDocParser\PhpDoc\ArrayItemNode;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDoc\StringNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Doctrine\Enum\MappingClass;
use Rector\Doctrine\NodeAnalyzer\AttributeFinder;
use Rector\NodeTypeResolver\PHPStan\Type\TypeFactory;

final readonly class ColumnPropertyTypeResolver
{
    /**
     * @var string
     */
    private const DATE_TIME_INTERFACE = 'DateTimeInterface';

    /**
     * @param array<string, Type> $doctrineTypeToScalarType
     * @see https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/basic-mapping.html#doctrine-mapping-types
     */
    public function __construct(
        private PhpDocInfoFactory $phpDocInfoFactory,
        private TypeFactory $typeFactory,
        private AttributeFinder $attributeFinder,
        private array $doctrineTypeToScalarType = [
            'tinyint' => new BooleanType(),
            'boolean' => new BooleanType(),
            // integers
            'smallint' => new IntegerType(),
            'mediumint' => new IntegerType(),
            'int' => new IntegerType(),
            'integer' => new IntegerType(),
            'numeric' => new IntegerType(),
            // floats
            'float' => new FloatType(),
            'double' => new FloatType(),
            'real' => new FloatType(),
            // strings
            'decimal' => new StringType(),
            'bigint' => new StringType(),
            'tinytext' => new StringType(),
            'mediumtext' => new StringType(),
            'longtext' => new StringType(),
            'text' => new StringType(),
            'varchar' => new StringType(),
            'string' => new StringType(),
            'char' => new StringType(),
            'longblob' => new MixedType(),
            'blob' => new MixedType(),
            'mediumblob' => new MixedType(),
            'tinyblob' => new MixedType(),
            'binary' => new StringType(),
            'varbinary' => new StringType(),
            'set' => new StringType(),
            // date time objects
            'date' => new ObjectType(self::DATE_TIME_INTERFACE),
            'datetime' => new ObjectType(self::DATE_TIME_INTERFACE),
            'timestamp' => new ObjectType(self::DATE_TIME_INTERFACE),
            'time' => new ObjectType(self::DATE_TIME_INTERFACE),
            'year' => new ObjectType(self::DATE_TIME_INTERFACE),
        ],
    ) {
    }

    public function resolve(Property $property, bool $isNullable): ?Type
    {
        $expr = $this->attributeFinder->findAttributeByClassArgByName($property, MappingClass::COLUMN, 'type');

        if ($expr instanceof String_) {
            return $this->createPHPStanTypeFromDoctrineStringType($expr->value, $isNullable);
        }

        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);
        return $this->resolveFromPhpDocInfo($phpDocInfo, $isNullable);
    }

    private function resolveFromPhpDocInfo(PhpDocInfo $phpDocInfo, bool $isNullable): null|Type
    {
        $doctrineAnnotationTagValueNode = $phpDocInfo->findOneByAnnotationClass(MappingClass::COLUMN);
        if (! $doctrineAnnotationTagValueNode instanceof DoctrineAnnotationTagValueNode) {
            return null;
        }

        $typeArrayItemNode = $doctrineAnnotationTagValueNode->getValue('type');
        if (! $typeArrayItemNode instanceof ArrayItemNode) {
            return new MixedType();
        }

        $typeValue = $typeArrayItemNode->value;

        if ($typeValue instanceof StringNode) {
            $typeValue = $typeValue->value;
        }

        if (! is_string($typeValue)) {
            return null;
        }

        return $this->createPHPStanTypeFromDoctrineStringType($typeValue, $isNullable);
    }

    private function createPHPStanTypeFromDoctrineStringType(string $type, bool $isNullable): Type
    {
        $scalarType = $this->doctrineTypeToScalarType[$type] ?? null;
        if (! $scalarType instanceof Type) {
            return new MixedType();
        }

        $types = [$scalarType];

        if ($isNullable) {
            $types[] = new NullType();
        }

        return $this->typeFactory->createMixedPassedOrUnionType($types);
    }
}
