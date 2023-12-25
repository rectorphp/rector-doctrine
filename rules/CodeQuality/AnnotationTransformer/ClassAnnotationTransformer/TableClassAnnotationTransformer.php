<?php

declare(strict_types=1);

namespace Utils\Rector\AnnotationTransformer\ClassAnnotationTransformer;

use Rector\BetterPhpDocParser\PhpDoc\ArrayItemNode;
use Rector\BetterPhpDocParser\PhpDoc\StringNode;
use Rector\BetterPhpDocParser\PhpDocInfo\PhpDocInfo;
use Utils\Rector\AnnotationTransformer\PropertyAnnotationTransformer\AbstractAnnotationTransformer;
use Utils\Rector\Contract\ClassAnnotationTransformerInterface;
use Utils\Rector\DocTagNodeFactory;
use Utils\Rector\ValueObject\EntityMapping;

final class TableClassAnnotationTransformer extends AbstractAnnotationTransformer implements ClassAnnotationTransformerInterface
{
    /**
     * @var string
     */
    private const TABLE_KEY = 'table';

    public function transform(EntityMapping $entityMapping, PhpDocInfo $classPhpDocInfo): void
    {
        $classMapping = $entityMapping->getClassMapping();

        $table = $classMapping[self::TABLE_KEY] ?? null;
        if (! is_string($table)) {
            return;
        }

        $arrayItemNodes = [new ArrayItemNode(new StringNode($table), self::TABLE_KEY)];

        $spacelessPhpDocTagNode = DocTagNodeFactory::createSpacelessPhpDocTagNode(
            $arrayItemNodes,
            $this->getClassName()
        );
        $classPhpDocInfo->addPhpDocTagNode($spacelessPhpDocTagNode);
    }

    public function getClassName(): string
    {
        return 'Doctrine\ORM\Mapping\Table';
    }

    /**
     * @return string[]
     */
    public function getQuotedFields(): array
    {
        return [];
    }
}
