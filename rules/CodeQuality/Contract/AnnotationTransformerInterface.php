<?php

declare(strict_types=1);

namespace Utils\Rector\Contract;

interface AnnotationTransformerInterface
{
    public function getClassName(): string;

    /**
     * @return string[]
     */
    public function getQuotedFields(): array;
}
