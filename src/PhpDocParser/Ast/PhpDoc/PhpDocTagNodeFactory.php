<?php

declare(strict_types=1);

namespace Rector\Doctrine\PhpDocParser\Ast\PhpDoc;

use PHPStan\PhpDocParser\Ast\PhpDoc\VarTagValueNode;
use PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;
use Rector\Doctrine\PhpDoc\Node\Property_\ColumnTagValueNode;
use Rector\Doctrine\PhpDoc\NodeFactory\Property_\ColumnTagValueNodeFactory;

final class PhpDocTagNodeFactory
{
    /**
     * @var ColumnTagValueNodeFactory
     */
    private $columnTagValueNodeFactory;

    public function __construct(ColumnTagValueNodeFactory $columnTagValueNodeFactory)
    {
        $this->columnTagValueNodeFactory = $columnTagValueNodeFactory;
    }

    public function createVarTagIntValueNode(): VarTagValueNode
    {
        $identifierTypeNode = new IdentifierTypeNode('int');
        return new VarTagValueNode($identifierTypeNode, '', '');
    }

    public function createIdColumnTagValueNode(): ColumnTagValueNode
    {
        return $this->columnTagValueNodeFactory->createFromItems([
            'type' => 'integer',
        ]);
    }
}
