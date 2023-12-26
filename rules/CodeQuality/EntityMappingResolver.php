<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality;

use PHPStan\Reflection\ReflectionProvider;
use Rector\Doctrine\CodeQuality\ValueObject\EntityMapping;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Yaml\Yaml;
use Webmozart\Assert\Assert;

final class EntityMappingResolver
{
    /**
     * @var EntityMapping[]
     */
    private array $entityMappings = [];

    public function __construct(
        private readonly ReflectionProvider $reflectionProvider,
    ) {
    }

    /**
     * @param string[] $yamlMappingDirectories
     * @return EntityMapping[]
     */
    public function resolveFromDirectories(array $yamlMappingDirectories): array
    {
        Assert::allString($yamlMappingDirectories);

        if ($this->entityMappings !== []) {
            return $this->entityMappings;
        }

        $yamlFileInfos = $this->findYamlFileInfos($yamlMappingDirectories);
        Assert::notEmpty($yamlFileInfos);

        $this->entityMappings = $this->createEntityMappingsFromYamlFileInfos($yamlFileInfos);
        Assert::notEmpty($this->entityMappings);

        return $this->entityMappings;
    }

    /**
     * @param string[] $yamlMappingDirectories
     * @return SplFileInfo[]
     */
    private function findYamlFileInfos(array $yamlMappingDirectories): array
    {
        Assert::notEmpty($yamlMappingDirectories);
        Assert::allString($yamlMappingDirectories);
        Assert::allFileExists($yamlMappingDirectories);

        $finder = new Finder();
        $finder->files()
            ->name('#\.(yml|yaml)$#')
            ->in($yamlMappingDirectories)
            // has same class-based key structure, so must be skipped explicitly
            ->notPath('DataFixtures')
            ->getIterator();

        return iterator_to_array($finder->getIterator());
    }

    /**
     * @param SplFileInfo[] $yamlFileInfos
     * @return EntityMapping[]
     */
    private function createEntityMappingsFromYamlFileInfos(array $yamlFileInfos): array
    {
        Assert::allIsInstanceOf($yamlFileInfos, SplFileInfo::class);

        $entityMappings = [];

        foreach ($yamlFileInfos as $yamlFileInfo) {
            // is a mapping file?
            $yaml = Yaml::parse($yamlFileInfo->getContents());

            foreach ($yaml as $key => $value) {
                // for tests
                if (! $this->reflectionProvider->hasClass($key) && ! str_contains(
                    (string) $key,
                    'Rector\Doctrine\Tests\CodeQuality'
                )) {
                    continue;
                }

                $entityMappings[] = new EntityMapping($key, $value);
            }
        }

        return $entityMappings;
    }
}
