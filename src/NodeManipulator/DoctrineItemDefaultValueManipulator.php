<?php

declare(strict_types=1);

namespace Rector\Doctrine\NodeManipulator;

use Rector\BetterPhpDocParser\PhpDoc\DoctrineAnnotationTagValueNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;

final class DoctrineItemDefaultValueManipulator
{
    /**
     * @param string|bool|int $defaultValue
     */
    public function remove(
        PhpDocInfo $phpDocInfo,
        DoctrineAnnotationTagValueNode $doctrineTagValueNode,
        string $item,
        $defaultValue
    ): void {
        // remover...
        dump($doctrineTagValueNode);
        die;

        if (! $this->hasItemWithDefaultValue($doctrineTagValueNode, $item, $defaultValue)) {
            return;
        }

        $doctrineTagValueNode->removeItem($item);
        $phpDocInfo->markAsChanged();
    }

    /**
     * @param string|bool|int $defaultValue
     */
    private function hasItemWithDefaultValue(
        AbstractDoctrineTagValueNode $doctrineTagValueNode,
        string $item,
        $defaultValue
    ): bool {
        $items = $doctrineTagValueNode->getItems();
        if (! isset($items[$item])) {
            return false;
        }

        return $items[$item] === $defaultValue;
    }
}
