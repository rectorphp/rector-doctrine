<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeFactory;

use PhpParser\Node\Stmt\Property;
use PHPStan\PhpDocParser\Ast\PhpDoc\VarTagValueNode;
use PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;
use Rector\BetterPhpDocParser\Attributes\Ast\PhpDoc\SpacelessPhpDocTagNode;
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
        $phpDocTagNodes = [];

        $phpDocTagNodes[] = new SpacelessPhpDocTagNode('@ORM\Id', new DoctrineAnnotationTagValueNode(
            'Doctrine\ORM\Mapping\Id', null, []
        ));

        $phpDocTagNodes[] = new SpacelessPhpDocTagNode('@ORM\Column', new DoctrineAnnotationTagValueNode(
            'Doctrine\ORM\Mapping\Column', null, [
                'type' => '"integer"',
            ]));

        $phpDocTagNodes[] = new SpacelessPhpDocTagNode('@ORM\GeneratedValue', new DoctrineAnnotationTagValueNode(
            'Doctrine\ORM\Mapping\GeneratedValue', null, [
                'strategy' => '"AUTO"',
            ]));

        foreach ($phpDocTagNodes as $phpDocTagNode) {
            $phpDocInfo->addPhpDocTagNode($phpDocTagNode);
        }

        $phpDocInfo->markAsChanged();
    }
}
