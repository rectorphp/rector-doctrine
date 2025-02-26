<?php

namespace Doctrine\Bundle\MongoDBBundle\Repository;

if (class_exists('Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository')) {
    return;
}

abstract class ServiceDocumentRepository
{
}
