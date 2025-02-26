<?php

declare(strict_types=1);

namespace Rector\Doctrine\CodeQuality\Enum;

final readonly class DoctrineClass
{
    /**
     * @var string
     */
    public const COLLECTION = 'Doctrine\Common\Collections\Collection';

    /**
     * @var string
     */
    public const SERVICE_DOCUMENT_REPOSITORY = 'Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository';

    /**
     * @var string
     */
    public const OBJECT_REPOSITORY = 'Doctrine\Persistence\ObjectRepository';
}
