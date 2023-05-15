<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeFactory;

use PhpParser\Node\Stmt\Property;
use PHPStan\PhpDocParser\Ast\PhpDoc\VarTagValueNode;
use PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;
use Rector\BetterPhpDocParser\PhpDoc\ArrayItemNode;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDoc\SpacelessPhpDocTagNode;
use Rector\BetterPhpDocParser\PhpDoc\StringNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Core\PhpParser\Node\NodeFactory;

final class EntityIdNodeFactory
{
    public function __construct(
        private readonly NodeFactory $nodeFactory,
        private readonly PhpDocInfoFactory $phpDocInfoFactory
    ) {
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
            new IdentifierTypeNode('Doctrine\ORM\Mapping\Id'),
            null,
            []
        ));

        $phpDocTagNodes[] = new SpacelessPhpDocTagNode('@ORM\Column', new DoctrineAnnotationTagValueNode(
            new IdentifierTypeNode('Doctrine\ORM\Mapping\Column'),
            null,
            [new ArrayItemNode(new StringNode('integer'), 'type')]
        ));

        $phpDocTagNodes[] = new SpacelessPhpDocTagNode('@ORM\GeneratedValue', new DoctrineAnnotationTagValueNode(
            new IdentifierTypeNode('Doctrine\ORM\Mapping\GeneratedValue'),
            null,
            [new ArrayItemNode(new StringNode('AUTO'), 'strategy')]
        ));

        foreach ($phpDocTagNodes as $phpDocTagNode) {
            $phpDocInfo->addPhpDocTagNode($phpDocTagNode);
        }

        $phpDocInfo->markAsChanged();
    }
}
