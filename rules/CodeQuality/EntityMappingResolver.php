<?php

declare(strict_types=1);

namespace Utils\Rector;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Yaml\Yaml;
use Utils\Rector\ValueObject\EntityMapping;
use Webmozart\Assert\Assert;

final class EntityMappingResolver
{
    /**
     * @var EntityMapping[]
     */
    private array $entityMappings = [];

    /**
     * @return EntityMapping[]
     */
    public function resolveFromDirectories(array $yamlMappingDirectories): array
    {
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
     * @return SplFileInfo[]
     */
    private function findYamlFileInfos(array $yamlMappingDirectories): array
    {
        Assert::notEmpty($yamlMappingDirectories);

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
                if (! class_exists($key) && ! str_contains($key, 'Utils\Rector\Tests\Rector')) {
                    continue;
                }

                $entityMappings[] = new EntityMapping($key, $value);
            }
        }

        return $entityMappings;
    }
}
