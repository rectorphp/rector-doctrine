<?php

declare(strict_types=1);

namespace Rector\Doctrine\PhpDoc\Node\Property_;

use Rector\BetterPhpDocParser\Printer\ArrayPartPhpDocTagPrinter;
use Rector\BetterPhpDocParser\Printer\TagValueNodePrinter;
use Rector\Doctrine\Contract\PhpDoc\Node\InversedByNodeInterface;
use Rector\Doctrine\Contract\PhpDoc\Node\MappedByNodeInterface;
use Rector\Doctrine\Contract\PhpDoc\Node\ToOneTagNodeInterface;
use Rector\Doctrine\PhpDoc\Node\AbstractDoctrineTagValueNode;

final class OneToOneTagValueNode extends AbstractDoctrineTagValueNode implements ToOneTagNodeInterface, MappedByNodeInterface, InversedByNodeInterface
{
    /**
     * @var string|null
     */
    private $fullyQualifiedTargetEntity;

    public function __construct(
        ArrayPartPhpDocTagPrinter $arrayPartPhpDocTagPrinter,
        TagValueNodePrinter $tagValueNodePrinter,
        array $items,
        ?string $content = null,
        ?string $fullyQualifiedTargetEntity = null
    ) {
        $this->fullyQualifiedTargetEntity = $fullyQualifiedTargetEntity;

        parent::__construct($arrayPartPhpDocTagPrinter, $tagValueNodePrinter, $items, $content);
    }

    public function getTargetEntity(): ?string
    {
        return $this->items['targetEntity'];
    }

    public function getFullyQualifiedTargetEntity(): ?string
    {
        return $this->fullyQualifiedTargetEntity;
    }

    public function getInversedBy(): ?string
    {
        return $this->items['inversedBy'];
    }

    public function getMappedBy(): ?string
    {
        return $this->items['mappedBy'];
    }

    public function removeInversedBy(): void
    {
        $this->items['inversedBy'] = null;
    }

    public function removeMappedBy(): void
    {
        $this->items['mappedBy'] = null;
    }

    public function changeTargetEntity(string $targetEntity): void
    {
        $this->items['targetEntity'] = $targetEntity;
    }

    public function getShortName(): string
    {
        return '@ORM\OneToOne';
    }
}
