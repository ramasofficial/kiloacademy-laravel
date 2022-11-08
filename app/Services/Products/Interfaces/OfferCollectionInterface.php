<?php

declare(strict_types=1);

namespace App\Services\Products\Interfaces;

use Iterator;

interface OfferCollectionInterface
{
    public function add(mixed $data): void;

    public function getIterator(): Iterator;

    public function count(): int;

    public function remove(int $index): void;
}
