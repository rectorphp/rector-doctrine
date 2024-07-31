<?php

use Doctrine\Common\Collections\Criteria;

$criteria = new Criteria();
$criteria->orderBy(['asc' => Criteria::ASC, 'desc' => Criteria::DESC]);

?>
-----
<?php

use Doctrine\Common\Collections\Criteria;

$criteria = new Criteria();
$criteria->orderBy(['asc' => \Doctrine\Common\Collections\Order::Ascending, 'desc' => \Doctrine\Common\Collections\Order::Descending]);

?>
