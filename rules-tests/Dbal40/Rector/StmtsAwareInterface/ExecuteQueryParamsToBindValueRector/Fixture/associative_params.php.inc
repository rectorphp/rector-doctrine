<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Dbal40\Rector\StmtsAwareInterface\ExecuteQueryParamsToBindValueRector\Fixture;

use Doctrine\DBAL\Statement;

final class AssociativeParams
{
    /**
     * @param array<string, mixed> $params
     */
    public function run(Statement $statement, array $params): void
    {
        $result = $statement->executeQuery($params);
    }
}

?>
-----
<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Dbal40\Rector\StmtsAwareInterface\ExecuteQueryParamsToBindValueRector\Fixture;

use Doctrine\DBAL\Statement;

final class AssociativeParams
{
    /**
     * @param array<string, mixed> $params
     */
    public function run(Statement $statement, array $params): void
    {
        foreach ($params as $key => $parameter) {
            $statement->bindValue(is_int($key) ? $key + 1 : $key, $parameter);
        }
        $result = $statement->executeQuery();
    }
}

?>
