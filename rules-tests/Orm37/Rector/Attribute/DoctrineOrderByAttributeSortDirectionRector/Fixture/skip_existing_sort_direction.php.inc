<?php

namespace Rector\Doctrine\Tests\Orm37\Rector\Attribute\DoctrineOrderByAttributeSortDirectionRector\Fixture;

use Doctrine\ORM\Mapping as ORM;
use SortDirection;
use SortDirection as Direction;

class SkipExistingSortDirection
{
    #[ORM\OrderBy(['ordering' => SortDirection::Ascending, 'date' => SortDirection::Descending])]
    protected array $imported;

    #[ORM\OrderBy(['ordering' => Direction::Ascending, 'date' => Direction::Descending])]
    protected array $aliased;

    #[ORM\OrderBy(['ordering' => \SortDirection::Ascending, 'date' => \SortDirection::Descending])]
    protected array $fullyQualified;
}
