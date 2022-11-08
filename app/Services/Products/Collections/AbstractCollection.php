<?php

declare(strict_types=1);

namespace App\Services\Products\Collections;

use ArrayIterator;
use Iterator;

abstract class AbstractCollection
{
    protected array $data = [];

    public function add(mixed $data): void
    {
        $this->data[] = $data;
    }

    public function getIterator(): Iterator
    {
        return new ArrayIterator($this->data);
    }

    public function count(): int
    {
        return count($this->data);
    }

    public function remove(int $index): void
    {
        unset($this->data[$index]);
    }
}
