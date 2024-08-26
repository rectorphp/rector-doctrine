<?php

use Doctrine\Common\Collections\Criteria as SomeAliasedCriteria;

$crit = new SomeAliasedCriteria();
$crit->orderBy(['param1' => \Doctrine\Common\Collections\Order::Ascending, 'param2' => SomeAliasedCriteria::DESC, 'param3' => 'asc']);

?>
-----
<?php

use Doctrine\Common\Collections\Criteria as SomeAliasedCriteria;

$crit = new SomeAliasedCriteria();
$crit->orderBy(['param1' => \Doctrine\Common\Collections\Order::Ascending, 'param2' => \Doctrine\Common\Collections\Order::Descending, 'param3' => \Doctrine\Common\Collections\Order::Ascending]);

?>
