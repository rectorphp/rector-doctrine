<?php

namespace Rector\Doctrine\Tests\ComposerBased\Fixture;

use Doctrine\ORM\ORMSetup;

final class VersionBoundOrmSetupRenames
{
    public function run(array $paths)
    {
        $attributeConfig = ORMSetup::createAttributeMetadataConfiguration($paths);
        $xmlConfig = ORMSetup::createXMLMetadataConfiguration($paths);
        $config = ORMSetup::createConfiguration();

        return [$attributeConfig, $xmlConfig, $config];
    }
}

?>
-----
<?php

namespace Rector\Doctrine\Tests\ComposerBased\Fixture;

use Doctrine\ORM\ORMSetup;

final class VersionBoundOrmSetupRenames
{
    public function run(array $paths)
    {
        $attributeConfig = ORMSetup::createAttributeMetadataConfig($paths);
        $xmlConfig = ORMSetup::createXMLMetadataConfig($paths);
        $config = ORMSetup::createConfig();

        return [$attributeConfig, $xmlConfig, $config];
    }
}

?>
