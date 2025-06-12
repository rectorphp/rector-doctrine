<?php

declare(strict_types=1);

namespace Doctrine\Common\Collections;

if (interface_exists('Doctrine\Common\Collections\Collection')) {
    return;
}

/**
 * @psalm-template TKey of array-key
 * @psalm-template T
 * @template-extends ReadableCollection<TKey, T>
 * @template-extends ArrayAccess<TKey, T>
 */
interface Collection extends ReadableCollection, \ArrayAccess
{
}
