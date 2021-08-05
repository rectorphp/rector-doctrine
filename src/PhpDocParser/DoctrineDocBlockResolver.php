<?php

declare(strict_types=1);

namespace Rector\Doctrine\PhpDocParser;

use PhpParser\Node;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Property;
use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfoFactory;
use Rector\NodeTypeResolver\Node\AttributeKey;
use Rector\TypeDeclaration\PhpDoc\ShortClassExpander;

final class DoctrineDocBlockResolver
{
    public function __construct(
        private PhpDocInfoFactory $phpDocInfoFactory,
        private ShortClassExpander $shortClassExpander
    ) {
    }

    public function isDoctrineEntityClass(Class_ $class): bool
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($class);
        return $phpDocInfo->hasByAnnotationClasses(['Doctrine\ORM\Mapping\Entity', 'Doctrine\ORM\Mapping\Embeddable']);
    }

    public function getTargetEntity(Property $property): ?string
    {
        $phpDocInfo = $this->phpDocInfoFactory->createFromNodeOrEmpty($property);

        $doctrineAnnotationTagValueNode = $phpDocInfo->getByAnnotationClasses([
            'Doctrine\ORM\Mapping\OneToMany',
            'Doctrine\ORM\Mapping\ManyToMany',
            'Doctrine\ORM\Mapping\OneToOne',
            'Doctrine\ORM\Mapping\ManyToOne',
        ]);

        if (! $doctrineAnnotationTagValueNode instanceof DoctrineAnnotationTagValueNode) {
            return null;
        }

        $targetEntity = $doctrineAnnotationTagValueNode->getValue('targetEntity');
        return $this->shortClassExpander->resolveFqnTargetEntity($targetEntity, $property);
    }

    public function isInDoctrineEntityClass(Node $node): bool
    {
        $classLike = $node->getAttribute(AttributeKey::CLASS_NODE);
        if (! $classLike instanceof Class_) {
            return false;
        }

        return $this->isDoctrineEntityClass($classLike);
    }
}
