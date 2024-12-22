<?php

declare(strict_types=1);

namespace Rector\Doctrine\TypeAnalyzer;

use PhpParser\Node\Param;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;
use PHPStan\Type\Generic\GenericObjectType;
use PHPStan\Type\IntegerType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\StringType;
use Rector\BetterPhpDocParser\PhpDoc\ArrayItemNode;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDoc\StringNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\PhpParser\AstResolver;

final readonly class CollectionTypeFactory
{
    public function __construct(
        private PhpDocInfoFactory $phpDocInfoFactory,
        private AstResolver $astResolver
    ) {
    }

    public function createType(ObjectType $objectType, bool $withIndexBy, Property|Param $property): GenericObjectType
    {
        $keyType = new IntegerType();

        if ($withIndexBy) {
            $keyType = $this->resolveKeyType($property, $objectType->getClassName());
        }

        $genericTypes = [$keyType, $objectType];

        return new GenericObjectType('Doctrine\Common\Collections\Collection', $genericTypes);
    }

    private function resolveKeyType(Property|Param $property, string $className): IntegerType|StringType
    {
        $class = $this->astResolver->resolveClassFromName($className);

        if (! $class instanceof Class_) {
            return new IntegerType();
        }

        $phpDocInfo = $this->phpDocInfoFactory->createFromNode($property);

        if ($phpDocInfo instanceof PhpDocInfo) {
            // only on OneToMany and ManyToMany
            // https://www.doctrine-project.org/projects/doctrine-orm/en/3.3/tutorials/working-with-indexed-associations.html#mapping-indexed-associations
            $annotations = $phpDocInfo->findByAnnotationClass('Doctrine\ORM\Mapping\OneToMany') !== []
                ? $phpDocInfo->findByAnnotationClass('Doctrine\ORM\Mapping\OneToMany')
                : $phpDocInfo->findByAnnotationClass('Doctrine\ORM\Mapping\ManyToMany');

            if (count($annotations) === 1 && $annotations[0] instanceof DoctrineAnnotationTagValueNode) {
                $key = null;
                foreach ($annotations[0]->getValues() as $arrayItemNode) {
                    if ($arrayItemNode instanceof ArrayItemNode && $arrayItemNode->key instanceof StringNode && $arrayItemNode->key->value === 'indexBy' && $arrayItemNode->value instanceof StringNode) {
                        $key = $arrayItemNode->value->value;
                        break;
                    }
                }

                if ($key !== null) {
                    // get property from class
                    $targetProperty = $class->getProperty($key);
                    if (! $targetProperty instanceof Property) {
                        return new IntegerType();
                    }

                    $phpDocInfoTargetClass = $this->phpDocInfoFactory->createFromNode($targetProperty);
                    if ($phpDocInfoTargetClass instanceof PhpDocInfo) {
                        $columns = $phpDocInfoTargetClass->findByAnnotationClass('Doctrine\ORM\Mapping\Column');

                        if (count($columns) === 1 && $columns[0] instanceof DoctrineAnnotationTagValueNode) {
                            $type = null;
                            foreach ($columns[0]->getValues() as $arrayItemNode) {
                                if ($arrayItemNode instanceof ArrayItemNode && $arrayItemNode->key === 'type' && $arrayItemNode->value instanceof StringNode) {
                                    $type = $arrayItemNode->value->value;
                                    break;
                                }
                            }

                            return $type === null
                                ? new IntegerType()
                                : ($type === 'string' ? new StringType() : new IntegerType());
                        }
                    }
                }
            }
        }

        // todo, resolve type from annotation/attribute
        //    -> use AstResolver to get target Class
        //         -> get property type from it
        //             -> resolve from its annotation/attribute
        // fallback to IntegerType
        return new IntegerType();
    }
}
