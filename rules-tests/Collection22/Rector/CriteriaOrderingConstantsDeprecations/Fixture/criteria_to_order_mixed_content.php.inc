<?php

use Doctrine\Common\Collections\Criteria;

$criteria = new Criteria();
$criteria->orderBy(['param1' => \Doctrine\Common\Collections\Order::Ascending, 'param2' => Criteria::DESC, 'param3' => 'asc']);

?>
-----
<?php

use Doctrine\Common\Collections\Criteria;

$criteria = new Criteria();
$criteria->orderBy(['param1' => \Doctrine\Common\Collections\Order::Ascending, 'param2' => \Doctrine\Common\Collections\Order::Descending, 'param3' => \Doctrine\Common\Collections\Order::Ascending]);

?>
