<?php

declare(strict_types=1);

namespace Rector\Doctrine\ValueObject;

final class OptionalAndRequiredParamNames
{
    /**
     * @param string[] $optionalParamNames
     * @param string[] $requiredParamNames
     */
    public function __construct(
        private array $optionalParamNames,
        private array $requiredParamNames
    ) {
    }

    /**
     * @return string[]
     */
    public function getOptionalParamNames(): array
    {
        return $this->optionalParamNames;
    }

    /**
     * @return string[]
     */
    public function getRequiredParamNames(): array
    {
        return $this->requiredParamNames;
    }
}
