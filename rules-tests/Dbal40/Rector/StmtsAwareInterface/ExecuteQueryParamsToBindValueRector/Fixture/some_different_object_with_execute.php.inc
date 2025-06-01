<?php

declare(strict_types=1);

namespace Rector\Doctrine\Tests\Dbal40\Rector\StmtsAwareInterface\ExecuteQueryParamsToBindValueRector\Fixture;

use Rector\Doctrine\Tests\Dbal40\Rector\StmtsAwareInterface\ExecuteQueryParamsToBindValueRector\Source\Statement;

final class SkipDifferentObjectWithExecute
{
    public function run(Statement $statement, array $params): void
    {
        $result = $statement->executeQuery($params);
    }
}
