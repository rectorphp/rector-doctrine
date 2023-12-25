<?php

declare(strict_types=1);

namespace Utils\Rector\AnnotationTransformer\ClassAnnotationTransformer;

use Rector\BetterPhpDocParser\PhpDoc\ArrayItemNode;
use Rector\BetterPhpDocParser\PhpDoc\StringNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Utils\Rector\Contract\ClassAnnotationTransformerInterface;
use Utils\Rector\DocTagNodeFactory;
use Utils\Rector\Utils\CaseStringHelper;
use Utils\Rector\ValueObject\EntityMapping;

final class SoftDeletableClassAnnotationTransformer implements ClassAnnotationTransformerInterface
{
    /**
     * @var string
     */
    private const SOFT_DELETEABLE = 'soft_deleteable';

    public function transform(EntityMapping $entityMapping, PhpDocInfo $classPhpDocInfo): void
    {
        $classMapping = $entityMapping->getClassMapping();

        $softDeletableMapping = $classMapping['gedmo'][self::SOFT_DELETEABLE] ?? null;
        if (! is_array($softDeletableMapping)) {
            return;
        }

        $arrayItemNodes = $this->createArrayItemNodes($softDeletableMapping);

        $spacelessPhpDocTagNode = DocTagNodeFactory::createSpacelessPhpDocTagNode(
            $arrayItemNodes,
            $this->getClassName()
        );
        $classPhpDocInfo->addPhpDocTagNode($spacelessPhpDocTagNode);
    }

    public function getClassName(): string
    {
        return 'Gedmo\Mapping\Annotation\SoftDeleteable';
    }

    /**
     * @return string[]
     */
    public function getQuotedFields(): array
    {
        return [];
    }

    /**
     * @param array<string, mixed> $softDeletableMapping
     * @return ArrayItemNode[]
     */
    private function createArrayItemNodes(array $softDeletableMapping): array
    {
        $arrayItemNodes = [];

        foreach ($softDeletableMapping as $fieldKey => $fieldValue) {
            $camelCaseFieldKey = CaseStringHelper::camelCase($fieldKey);

            $arrayItemNodes[] = new ArrayItemNode(new StringNode($fieldValue), $camelCaseFieldKey);
        }

        return $arrayItemNodes;
    }
}
