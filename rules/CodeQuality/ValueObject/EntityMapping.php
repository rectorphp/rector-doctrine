<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\ValueObject;

use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Param;
use PhpParser\Node\Stmt\Property;
use Rector\Exception\ShouldNotHappenException;
use Webmozart\Assert\Assert;

final class EntityMapping
{
    /**
     * @var array<string, mixed>
     */
    private array $entityMapping;

    /**
     * @param array<string, mixed> $propertyMapping
     */
    public function __construct(
        private readonly string $className,
        array $propertyMapping
    ) {
        Assert::allString(array_keys($propertyMapping));
        $this->entityMapping = $propertyMapping;
    }

    public function getClassName(): string
    {
        return $this->className;
    }

    /**
     * @return mixed[]|null
     */
    public function matchFieldPropertyMapping(Property|Param $property): ?array
    {
        $propertyName = $this->getPropertyName($property);

        return $this->entityMapping['fields'][$propertyName] ?? null;
    }

    /**
     * @return mixed[]|null
     */
    public function matchEmbeddedPropertyMapping(Property|Param $property): ?array
    {
        $propertyName = $this->getPropertyName($property);

        return $this->entityMapping['embedded'][$propertyName] ?? null;
    }

    /**
     * @return array<string, mixed>|null
     */
    public function matchManyToOnePropertyMapping(Property|Param $property): ?array
    {
        $propertyName = $this->getPropertyName($property);
        return $this->entityMapping['manyToOne'][$propertyName] ?? null;
    }

    /**
     * @return array<string, mixed>|null
     */
    public function matchOneToManyPropertyMapping(Property|Param $property): ?array
    {
        $propertyName = $this->getPropertyName($property);
        return $this->entityMapping['oneToMany'][$propertyName] ?? null;
    }

    /**
     * @return array<string, mixed>
     */
    public function getClassMapping(): array
    {
        $classMapping = $this->entityMapping;
        unset($classMapping['fields']);
        unset($classMapping['oneToMany']);

        return $classMapping;
    }

    /**
     * @return array<string, mixed>|null
     */
    public function matchIdPropertyMapping(Property|Param $property): ?array
    {
        $propertyName = $this->getPropertyName($property);

        return $this->entityMapping['id'][$propertyName] ?? null;
    }

    private function getPropertyName(Property|Param $property): string
    {
        if ($property instanceof Property) {
            return $property->props[0]->name->toString();
        }

        if ($property->var instanceof Variable) {
            $paramName = $property->var->name;
            Assert::string($paramName);
            return $paramName;
        }

        throw new ShouldNotHappenException();
    }
}
