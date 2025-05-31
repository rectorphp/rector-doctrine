<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Dbal40\Rector\StmtsAwareInterface\ExecuteQueryParamsToBindValueRector\Fixture;

use Doctrine\DBAL\Statement;

final class SomeFileWithExecute
{
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

final class SomeFileWithExecute
{
    public function run(Statement $statement, array $params): void
    {
        foreach ($params as $position => $parameter) {
            $statement->bindValue($position + 1, $parameter);
        }
        $result = $statement->executeQuery();
    }
}

?>
