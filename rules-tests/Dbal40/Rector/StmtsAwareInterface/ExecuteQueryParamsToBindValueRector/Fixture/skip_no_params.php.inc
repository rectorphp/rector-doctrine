<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Dbal40\Rector\StmtsAwareInterface\ExecuteQueryParamsToBindValueRector\Fixture;

use Doctrine\DBAL\Statement;

final class SkipNoParams
{
    public function run(Statement $statement, array $params): void
    {
        $result = $statement->executeQuery();
    }
}
