<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeFactory;

use PhpParser\Node\Stmt\Property;
use PHPStan\PhpDocParser\Ast\PhpDoc\VarTagValueNode;
use PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\BetterPhpDocParser\Printer\ArrayPartPhpDocTagPrinter;
use Rector\BetterPhpDocParser\Printer\TagValueNodePrinter;
use Rector\Core\PhpParser\Node\NodeFactory;
use Rector\Doctrine\PhpDoc\Node\Property_\GeneratedValueTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Property_\IdTagValueNode;
use Rector\Doctrine\PhpDoc\NodeFactory\Property_\ColumnTagValueNodeFactory;

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

    /**
     * @var ColumnTagValueNodeFactory
     */
    private $columnTagValueNodeFactory;

    public function __construct(
        NodeFactory $nodeFactory,
        PhpDocInfoFactory $phpDocInfoFactory,
        ArrayPartPhpDocTagPrinter $arrayPartPhpDocTagPrinter,
        TagValueNodePrinter $tagValueNodePrinter,
        ColumnTagValueNodeFactory $columnTagValueNodeFactory
    ) {
        $this->nodeFactory = $nodeFactory;
        $this->phpDocInfoFactory = $phpDocInfoFactory;
        $this->arrayPartPhpDocTagPrinter = $arrayPartPhpDocTagPrinter;
        $this->tagValueNodePrinter = $tagValueNodePrinter;
        $this->columnTagValueNodeFactory = $columnTagValueNodeFactory;
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
        $idTagValueNode = new IdTagValueNode($this->arrayPartPhpDocTagPrinter, $this->tagValueNodePrinter);
        $phpDocInfo->addTagValueNodeWithShortName($idTagValueNode);

        $idColumnTagValueNode = $this->columnTagValueNodeFactory->createFromItems([
            'type' => 'integer',
        ]);
        $phpDocInfo->addTagValueNodeWithShortName($idColumnTagValueNode);

        $generatedValueTagValueNode = new GeneratedValueTagValueNode(
            $this->arrayPartPhpDocTagPrinter,
            $this->tagValueNodePrinter,
            [
                'strategy' => 'AUTO',
            ]);
        $phpDocInfo->addTagValueNodeWithShortName($generatedValueTagValueNode);
    }
}
