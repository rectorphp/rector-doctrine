<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeFactory;

use PhpParser\Node\Name\FullyQualified;
use PhpParser\Node\Stmt\Class_;
use PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDoc\SpacelessPhpDocTagNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\Core\NodeManipulator\ClassInsertManipulator;

final class TranslationClassNodeFactory
{
    public function __construct(
        private PhpDocInfoFactory $phpDocInfoFactory,
        private ClassInsertManipulator $classInsertManipulator
    ) {
    }

    public function create(string $classShortName): Class_
    {
        $class = new Class_($classShortName);
        $class->implements[] = new FullyQualified('Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface');
        $this->classInsertManipulator->addAsFirstTrait(
            $class,
            'Knp\DoctrineBehaviors\Model\Translatable\TranslationTrait'
        );

        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($class);

        $spacelessPhpDocTagNode = new SpacelessPhpDocTagNode(
            '@ORM\Entity',
            new DoctrineAnnotationTagValueNode(new IdentifierTypeNode('Doctrine\ORM\Mapping\Entity'), null, [])
        );

        $phpDocInfo->addPhpDocTagNode($spacelessPhpDocTagNode);

        return $class;
    }
}
