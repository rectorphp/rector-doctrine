<?php

declare(strict_types=1);

namespace Rector\Doctrine\PhpDoc\NodeFactory;

use Doctrine\ORM\Mapping\Annotation;
use Doctrine\ORM\Mapping\Embedded;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OneToOne;
use PhpParser\Node;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTagValueNode;
use PHPStan\PhpDocParser\Parser\TokenIterator;
use Rector\BetterPhpDocParser\Contract\MultiPhpDocNodeFactoryInterface;
use Rector\BetterPhpDocParser\Contract\PhpDocNodeFactoryInterface;
use Rector\BetterPhpDocParser\PhpDocNodeFactory\AbstractPhpDocNodeFactory;
use Rector\BetterPhpDocParser\Printer\ArrayPartPhpDocTagPrinter;
use Rector\BetterPhpDocParser\Printer\TagValueNodePrinter;
use Rector\BetterPhpDocParser\ValueObject\PhpDocNode\AbstractTagValueNode;
use Rector\Doctrine\Contract\PhpDoc\Node\DoctrineRelationTagValueNodeInterface;
use Rector\Doctrine\PhpDoc\Node\Class_\EmbeddableTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Class_\EmbeddedTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Class_\EntityTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Class_\InheritanceTypeTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Gedmo\BlameableTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Gedmo\LocaleTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Gedmo\LoggableTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Gedmo\SlugTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Gedmo\SoftDeleteableTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Gedmo\TranslatableTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Gedmo\TreeLeftTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Gedmo\TreeLevelTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Gedmo\TreeParentTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Gedmo\TreeRightTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Gedmo\TreeRootTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Gedmo\TreeTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Gedmo\VersionedTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Property_\ColumnTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Property_\CustomIdGeneratorTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Property_\GeneratedValueTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Property_\IdTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Property_\JoinColumnTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Property_\ManyToManyTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Property_\ManyToOneTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Property_\OneToManyTagValueNode;
use Rector\Doctrine\PhpDoc\Node\Property_\OneToOneTagValueNode;

final class MultiPhpDocNodeFactory extends AbstractPhpDocNodeFactory implements PhpDocNodeFactoryInterface, MultiPhpDocNodeFactoryInterface
{
    /**
     * @var ArrayPartPhpDocTagPrinter
     */
    private $arrayPartPhpDocTagPrinter;

    /**
     * @var TagValueNodePrinter
     */
    private $tagValueNodePrinter;

    public function __construct(
        ArrayPartPhpDocTagPrinter $arrayPartPhpDocTagPrinter,
        TagValueNodePrinter $tagValueNodePrinter
    ) {
        $this->arrayPartPhpDocTagPrinter = $arrayPartPhpDocTagPrinter;
        $this->tagValueNodePrinter = $tagValueNodePrinter;
    }

    /**
     * @return array<class-string<AbstractTagValueNode>, class-string<Annotation>>
     */
    public function getTagValueNodeClassesToAnnotationClasses(): array
    {
        return [
            // tag value node class => annotation class

            // Doctrine - intentionally in string, so prefixer wont miss it
            EmbeddableTagValueNode::class => 'Doctrine\ORM\Mapping\Embeddable',
            EntityTagValueNode::class => 'Doctrine\ORM\Mapping\Entity',
            InheritanceTypeTagValueNode::class => 'Doctrine\ORM\Mapping\InheritanceType',
            ColumnTagValueNode::class => 'Doctrine\ORM\Mapping\Column',
            CustomIdGeneratorTagValueNode::class => 'Doctrine\ORM\Mapping\CustomIdGenerator',
            IdTagValueNode::class => 'Doctrine\ORM\Mapping\Id',
            GeneratedValueTagValueNode::class => 'Doctrine\ORM\Mapping\GeneratedValue',
            JoinColumnTagValueNode::class => 'Doctrine\ORM\Mapping\JoinColumn',

            // Gedmo
            LocaleTagValueNode::class => 'Gedmo\Mapping\Annotation\Locale',
            BlameableTagValueNode::class => 'Gedmo\Mapping\Annotation\Blameable',
            SlugTagValueNode::class => 'Gedmo\Mapping\Annotation\Slug',
            SoftDeleteableTagValueNode::class => 'Gedmo\Mapping\Annotation\SoftDeleteable',
            TreeRootTagValueNode::class => 'Gedmo\Mapping\Annotation\TreeRoot',
            TreeLeftTagValueNode::class => 'Gedmo\Mapping\Annotation\TreeLeft',
            TreeLevelTagValueNode::class => 'Gedmo\Mapping\Annotation\TreeLevel',
            TreeParentTagValueNode::class => 'Gedmo\Mapping\Annotation\TreeParent',
            TreeRightTagValueNode::class => 'Gedmo\Mapping\Annotation\TreeRight',
            VersionedTagValueNode::class => 'Gedmo\Mapping\Annotation\Versioned',
            TranslatableTagValueNode::class => 'Gedmo\Mapping\Annotation\Translatable',
            LoggableTagValueNode::class => 'Gedmo\Mapping\Annotation\Loggable',
            TreeTagValueNode::class => 'Gedmo\Mapping\Annotation\Tree',

            // Doctrine
            OneToOneTagValueNode::class => 'Doctrine\ORM\Mapping\OneToOne',
            OneToManyTagValueNode::class => 'Doctrine\ORM\Mapping\OneToMany',
            ManyToManyTagValueNode::class => 'Doctrine\ORM\Mapping\ManyToMany',
            ManyToOneTagValueNode::class => 'Doctrine\ORM\Mapping\ManyToOne',
            // @todo cover with reflection / services to avoid forgetting registering it?
            EmbeddedTagValueNode::class => 'Doctrine\ORM\Mapping\Embedded',
        ];
    }

    public function createFromNodeAndTokens(
        Node $node,
        TokenIterator $tokenIterator,
        string $annotationClass
    ): ?PhpDocTagValueNode {
        $annotation = $this->nodeAnnotationReader->readAnnotation($node, $annotationClass);
        if ($annotation === null) {
            return null;
        }

        $tagValueNodeClassesToAnnotationClasses = $this->getTagValueNodeClassesToAnnotationClasses();
        $tagValueNodeClass = array_search($annotationClass, $tagValueNodeClassesToAnnotationClasses, true);
        if ($tagValueNodeClass === false) {
            return null;
        }

        $items = $this->annotationItemsResolver->resolve($annotation);
        $content = $this->annotationContentResolver->resolveFromTokenIterator($tokenIterator);

        if (is_a($tagValueNodeClass, DoctrineRelationTagValueNodeInterface::class, true)) {
            /** @var ManyToOne|OneToMany|ManyToMany|OneToOne|Embedded $annotation */
            $fullyQualifiedTargetEntity = $this->resolveEntityClass($annotation, $node);
            return new $tagValueNodeClass(
                $this->arrayPartPhpDocTagPrinter,
                $this->tagValueNodePrinter,
                $items,
                $content,
                $fullyQualifiedTargetEntity
            );
        }

        return new $tagValueNodeClass(
            $this->arrayPartPhpDocTagPrinter,
            $this->tagValueNodePrinter,
            $items,
            $content
        );
    }

    /**
     * @param ManyToOne|OneToMany|ManyToMany|OneToOne|Embedded $annotation
     */
    private function resolveEntityClass(object $annotation, Node $node): string
    {
        if ($annotation instanceof Embedded) {
            return $this->resolveFqnTargetEntity($annotation->class, $node);
        }

        return $this->resolveFqnTargetEntity($annotation->targetEntity, $node);
    }
}
