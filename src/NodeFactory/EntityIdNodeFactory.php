<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeFactory;

use PhpParser\Node\Stmt\Property;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTagNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\VarTagValueNode;
use PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\BetterPhpDocParser\Printer\ArrayPartPhpDocTagPrinter;
use Rector\BetterPhpDocParser\Printer\TagValueNodePrinter;
use Rector\Core\PhpParser\Node\NodeFactory;

final class EntityIdNodeFactory
{
    /**
     * @var NodeFactory
     */
    private $nodeFactory;

    /**
     * @var PhpDocInfoFactory
     */
    private $phpDocInfoFactory;

    /**
     * @var ArrayPartPhpDocTagPrinter
     */
    private $arrayPartPhpDocTagPrinter;

    /**
     * @var TagValueNodePrinter
     */
    private $tagValueNodePrinter;

    public function __construct(NodeFactory $nodeFactory, PhpDocInfoFactory $phpDocInfoFactory)
    {
        $this->nodeFactory = $nodeFactory;
        $this->phpDocInfoFactory = $phpDocInfoFactory;
    }

    public function createIdProperty(): Property
    {
        $idProperty = $this->nodeFactory->createPrivateProperty('id');
        $this->decoratePropertyWithIdAnnotations($idProperty);

        return $idProperty;
    }

    private function decoratePropertyWithIdAnnotations(Property $property): void
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);

        // add @var int
        $identifierTypeNode = new IdentifierTypeNode('int');
        $varTagValueNode = new VarTagValueNode($identifierTypeNode, '', '');
        $phpDocInfo->addTagValueNode($varTagValueNode);

        // add @ORM\Id
        $idTagValueNode = new PhpDocTagNode('@ORM\Id', new DoctrineAnnotationTagValueNode(
            'Doctrine\ORM\Mapping\Id', null, []
        ));

        $phpDocInfo->addPhpDocTagNode($idTagValueNode);

        $idColumnTagValueNode = new PhpDocTagNode('@ORM\Column', new DoctrineAnnotationTagValueNode(
            'Doctrine\ORM\Mapping\Column', null, [
                'type' => 'integer',
            ]));
        $phpDocInfo->addPhpDocTagNode($idColumnTagValueNode);

        $generatedValueTagValueNode = new PhpDocTagNode('@ORM\Generated', new DoctrineAnnotationTagValueNode(
            'Doctrine\ORM\Mapping\Generated', null, [
                'strategy' => 'AUTO',
            ]));
        $phpDocInfo->addPhpDocTagNode($generatedValueTagValueNode);

        $phpDocInfo->markAsChanged();
    }
}
