<?php

declare(strict_types=1);

namespace Rector\Doctrine\Enum;

final class DoctrineClass
{
    public const string ABSTRACT_FIXTURE = 'Doctrine\Common\DataFixtures\AbstractFixture';

    public const string AS_DOCTRINE_LISTENER_ATTRIBUTE = 'Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener';

    public const string EVENT_SUBSCRIBER = 'Doctrine\Common\EventSubscriber';

    public const string EVENT_SUBSCRIBER_INTERFACE = 'Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface';

    public const string COLLECTION = 'Doctrine\Common\Collections\Collection';

    public const string ARRAY_COLLECTION = 'Doctrine\Common\Collections\ArrayCollection';

    public const string SERVICE_DOCUMENT_REPOSITORY = 'Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository';

    public const string SERVICE_ENTITY_REPOSITORY = 'Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository';

    public const string ENTITY_REPOSITORY = 'Doctrine\ORM\EntityRepository';

    public const string OBJECT_REPOSITORY = 'Doctrine\Persistence\ObjectRepository';

    public const string ARRAY_RESULT = 'Doctrine\DBAL\Cache\ArrayResult';

    public const string CONNECTION = 'Doctrine\DBAL\Connection';

    public const string RESULT_STATEMENT = 'Doctrine\DBAL\Driver\ResultStatement';

    public const string DBAL_QUERY_BUILDER = 'Doctrine\DBAL\Query\QueryBuilder';

    public const string QUERY_EXPR = 'Doctrine\ORM\Query\Expr';

    public const string QUERY_PARAMETER = 'Doctrine\ORM\Query\Parameter';

    public const string DBAL_STATEMENT = 'Doctrine\DBAL\Statement';

    public const string COMPOSITE_EXPRESSION = 'Doctrine\DBAL\Query\Expression\CompositeExpression';

    public const string ABSTRACT_QUERY = 'Doctrine\ORM\AbstractQuery';

    public const string LIFECYCLE_EVENT_ARGS = 'Doctrine\ORM\Event\LifecycleEventArgs';

    public const string COLLECTIONS_CRITERIA = 'Doctrine\Common\Collections\Criteria';

    public const string QUERY_BUILDER = 'Doctrine\ORM\QueryBuilder';

    public const string ORDER = 'Doctrine\Common\Collections\Order';
}
