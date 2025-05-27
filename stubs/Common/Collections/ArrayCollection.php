<?php

declare(strict_types=1);

namespace Doctrine\Common\Collections;

use Closure;
use Traversable;

if (class_exists('Doctrine\Common\Collections\ArrayCollection')) {
    return;
}

class ArrayCollection implements Collection
{
    public function __construct(array $items)
    {

    }

    public function add(mixed $element)
    {
        // TODO: Implement add() method.
    }

    public function clear()
    {
        // TODO: Implement clear() method.
    }

    public function remove(int|string $key)
    {
        // TODO: Implement remove() method.
    }

    public function removeElement(mixed $element)
    {
        // TODO: Implement removeElement() method.
    }

    public function set(int|string $key, mixed $value)
    {
        // TODO: Implement set() method.
    }

    public function map(Closure $func)
    {
        // TODO: Implement map() method.
    }

    public function filter(Closure $p)
    {
        // TODO: Implement filter() method.
    }

    public function partition(Closure $p)
    {
        // TODO: Implement partition() method.
    }

    public function getIterator(): Traversable
    {
        // TODO: Implement getIterator() method.
    }

    public function offsetExists(mixed $offset): bool
    {
        // TODO: Implement offsetExists() method.
    }

    public function offsetGet(mixed $offset): mixed
    {
        // TODO: Implement offsetGet() method.
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        // TODO: Implement offsetSet() method.
    }

    public function offsetUnset(mixed $offset): void
    {
        // TODO: Implement offsetUnset() method.
    }

    public function count(): int
    {
        // TODO: Implement count() method.
    }

    public function contains(mixed $element)
    {
        // TODO: Implement contains() method.
    }

    public function isEmpty()
    {
        // TODO: Implement isEmpty() method.
    }

    public function containsKey(int|string $key)
    {
        // TODO: Implement containsKey() method.
    }

    public function get(int|string $key)
    {
        // TODO: Implement get() method.
    }

    public function getKeys()
    {
        // TODO: Implement getKeys() method.
    }

    public function getValues()
    {
        // TODO: Implement getValues() method.
    }

    public function toArray()
    {
        // TODO: Implement toArray() method.
    }

    public function first()
    {
        // TODO: Implement first() method.
    }

    public function last()
    {
        // TODO: Implement last() method.
    }

    public function key()
    {
        // TODO: Implement key() method.
    }

    public function current()
    {
        // TODO: Implement current() method.
    }

    public function next()
    {
        // TODO: Implement next() method.
    }

    public function slice(int $offset, ?int $length = null)
    {
        // TODO: Implement slice() method.
    }

    public function exists(Closure $p)
    {
        // TODO: Implement exists() method.
    }

    public function forAll(Closure $p)
    {
        // TODO: Implement forAll() method.
    }

    public function indexOf(mixed $element)
    {
        // TODO: Implement indexOf() method.
    }

    public function findFirst(Closure $p)
    {
        // TODO: Implement findFirst() method.
    }

    public function reduce(Closure $func, mixed $initial = null)
    {
        // TODO: Implement reduce() method.
    }
}
