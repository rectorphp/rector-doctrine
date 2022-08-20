<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeFactory;

use PhpParser\Builder\Method;
use PhpParser\Node\Expr;
use PhpParser\Node\Identifier;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Return_;
use PHPStan\Type\ArrayType;
use PHPStan\Type\MixedType;
use PHPStan\Type\StringType;
use Rector\BetterPhpDocParser\PhpDoc\ArrayItemNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\BetterPhpDocParser\PhpDocManipulator\PhpDocTypeChanger;
use Rector\PhpAttribute\AnnotationToAttributeMapper;

final class SluggableClassMethodFactory
{
    public function __construct(
        private readonly PhpDocInfoFactory $phpDocInfoFactory,
        private readonly PhpDocTypeChanger $phpDocTypeChanger,
        private readonly AnnotationToAttributeMapper $annotationToAttributeMapper,
    ) {
    }

    public function createGetSluggableFields(ArrayItemNode $arrayItemNode): ClassMethod
    {
        $builderClassMethod = new Method('getSluggableFields');
        $builderClassMethod->makePublic();
        $builderClassMethod->setReturnType(new Identifier('array'));

        /** @var Expr $slugFieldsExprs */
        $slugFieldsExprs = $this->annotationToAttributeMapper->map($arrayItemNode->value);
        $builderClassMethod->addStmt(new Return_($slugFieldsExprs));

        $classMethod = $builderClassMethod->getNode();

        $returnArrayType = new ArrayType(new MixedType(), new StringType());

        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($classMethod);
        $this->phpDocTypeChanger->changeReturnType($phpDocInfo, $returnArrayType);

        return $classMethod;
    }
}
