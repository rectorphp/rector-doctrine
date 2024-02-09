<?php

namespace Doctrine\DBAL\Driver;

if (! class_exists('Doctrine\DBAL\Driver\ResultStatement')) {
    return;
}

class ResultStatement
{
    public function fetchAll($fetchMode = null, $fetchArgument = null, $ctorArgs = null)
    {
    }
}
