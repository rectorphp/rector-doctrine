<?php

declare(strict_types=1);

namespace Utils\Rector\AnnotationTransformer\PropertyAnnotationTransformer;

use Rector\BetterPhpDocParser\PhpDoc\ArrayItemNode;
use Rector\BetterPhpDocParser\PhpDoc\StringNode;
use Utils\Rector\Contract\AnnotationTransformerInterface;
use Utils\Rector\Enum\EntityMappingKey;

abstract class AbstractAnnotationTransformer implements AnnotationTransformerInterface
{
    /**
     * These are handled in their own transformers
     *
     * @var string[]
     */
    private const EXTENSION_KEYS = ['gedmo'];

    /**
     * @param array<string, mixed> $propertyMapping
     * @return ArrayItemNode[]
     */
    protected function createArrayItemNodes(array $propertyMapping): array
    {
        $arrayItemNodes = [];

        foreach ($propertyMapping as $fieldKey => $fieldValue) {
            if (in_array($fieldKey, self::EXTENSION_KEYS, true)) {
                continue;
            }

            if (in_array($fieldKey, $this->getQuotedFields(), true)) {
                $arrayItemNodes[] = new ArrayItemNode(new StringNode($fieldValue), $fieldKey);
                continue;
            }

            if ($fieldKey === EntityMappingKey::NULLABLE) {
                $arrayItemNodes[] = new ArrayItemNode($fieldValue === true ? 'true' : 'false', $fieldKey);
                continue;
            }

            $arrayItemNodes[] = new ArrayItemNode($fieldValue, $fieldKey);
        }

        return $arrayItemNodes;
    }
}
