<?php

declare(strict_types=1);

namespace Rector\Doctrine\Enum;

final class OdmMappingClass
{
    public const string DOCUMENT = 'Doctrine\ODM\MongoDB\Mapping\Annotations\Document';

    public const string REFERENCE_MANY = 'Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany';

    public const string REFERENCE_ONE = 'Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceOne';

    public const string EMBED_MANY = 'Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedMany';

    public const string EMBED_ONE = 'Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedOne';
}
