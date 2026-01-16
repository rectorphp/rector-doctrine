<?php

declare(strict_types=1);

namespace Rector\Doctrine\Enum;

final class EventClass
{
    public const string PRE_PERSIST_EVENT_ARGS = 'Doctrine\ORM\Event\PrePersistEventArgs';

    public const string PRE_UPDATE_EVENT_ARGS = 'Doctrine\ORM\Event\PreUpdateEventArgs';

    public const string PRE_REMOVE_EVENT_ARGS = 'Doctrine\ORM\Event\PreRemoveEventArgs';

    public const string POST_PERSIST_EVENT_ARGS = 'Doctrine\ORM\Event\PostPersistEventArgs';

    public const string POST_UPDATE_EVENT_ARGS = 'Doctrine\ORM\Event\PostUpdateEventArgs';

    public const string POST_REMOVE_EVENT_ARGS = 'Doctrine\ORM\Event\PostRemoveEventArgs';

    public const string POST_LOAD_EVENT_ARGS = 'Doctrine\ORM\Event\PostLoadEventArgs';

    /**
     * @var array<class-string>
     */
    public const array ALL = [
        self::PRE_PERSIST_EVENT_ARGS,
        self::PRE_UPDATE_EVENT_ARGS,
        self::PRE_REMOVE_EVENT_ARGS,
        self::POST_PERSIST_EVENT_ARGS,
        self::POST_UPDATE_EVENT_ARGS,
        self::POST_REMOVE_EVENT_ARGS,
        self::POST_LOAD_EVENT_ARGS,
    ];
}
