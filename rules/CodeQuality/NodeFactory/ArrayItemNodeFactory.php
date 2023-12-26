<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\NodeFactory;

use Rector\BetterPhpDocParser\PhpDoc\ArrayItemNode;
use Rector\BetterPhpDocParser\PhpDoc\StringNode;
use Rector\Doctrine\CodeQuality\Enum\EntityMappingKey;
use Webmozart\Assert\Assert;

final class ArrayItemNodeFactory
{
    /**
     * These are handled in their own transformers
     *
     * @var string[]
     */
    private const EXTENSION_KEYS = ['gedmo'];

    /**
     * @param array<string, mixed> $propertyMapping
     * @param string[] $quotedFields
     *
     * @return ArrayItemNode[]
     */
    public function create(array $propertyMapping, array $quotedFields): array
    {
        Assert::allString($quotedFields);

        $arrayItemNodes = [];

        foreach ($propertyMapping as $fieldKey => $fieldValue) {
            if (in_array($fieldKey, self::EXTENSION_KEYS, true)) {
                continue;
            }

            if (in_array($fieldKey, $quotedFields, true)) {
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
