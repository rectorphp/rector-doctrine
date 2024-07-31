<?php

use Doctrine\Common\Collections\Criteria;

$query->addOrderBy('someParameter', Criteria::ASC);

?>
-----
<?php

use Doctrine\Common\Collections\Criteria;

$query->addOrderBy('someParameter', 'ASC');

?>
