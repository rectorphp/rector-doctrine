<?php

declare(strict_types=1);

namespace Rector\Doctrine\Set;

/**
 * @api
 */
final class DoctrineSetList
{
    public const string COMPOSER_BASED = __DIR__ . '/../../config/sets/composer-based.php';

    public const string TYPED_COLLECTIONS = __DIR__ . '/../../config/sets/typed-collections.php';

    public const string TYPED_COLLECTIONS_DOCBLOCKS = __DIR__ . '/../../config/sets/typed-collections-docblocks.php';

    public const string DOCTRINE_CODE_QUALITY = __DIR__ . '/../../config/sets/doctrine-code-quality.php';

    public const string ANNOTATIONS_TO_ATTRIBUTES = __DIR__ . '/../../config/sets/attributes/doctrine.php';

    public const string GEDMO_ANNOTATIONS_TO_ATTRIBUTES = __DIR__ . '/../../config/sets/attributes/gedmo.php';

    public const string MONGODB_ANNOTATIONS_TO_ATTRIBUTES = __DIR__ . '/../../config/sets/attributes/mongodb.php';
}
